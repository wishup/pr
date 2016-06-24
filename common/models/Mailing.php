<?php

namespace common\models;

use Yii;
use common\components\Email;

/**
 * This is the model class for table "mailing".
 *
 * @property integer $id
 * @property string $title
 * @property string $from_name
 * @property string $from_email
 * @property string $subject
 * @property string $message
 * @property string $start_at
 * @property integer $frequency
 * @property integer $final_notification
 * @property integer $paused
 * @property integer $finished
 * @property string $created_at
 *
 * @property MailingUsers[] $mailingUsers
 */
class Mailing extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mailing';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'message', 'from_name', 'from_email', 'email_count', 'frequency', 'start_at', 'subject'], 'required'],
            [['message'], 'string'],
            [['start_at', 'last_at', 'created_at'], 'safe'],
            [['frequency', 'final_notification', 'paused', 'finished', 'email_count'], 'integer'],
            [['title'], 'string', 'max' => 200],
            [['from_name', 'from_email'], 'string', 'max' => 100],
            [['subject'], 'string', 'max' => 300]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'from_name' => 'From Name',
            'from_email' => 'From Email',
            'subject' => 'Subject',
            'message' => 'Message',
            'start_at' => 'Start At',
            'last_at' => 'Last At',
            'frequency' => 'Frequency',
            'final_notification' => 'Send final notification',
            'paused' => 'Paused',
            'finished' => 'Finished',
            'created_at' => 'Created At',
            'email_count' => 'Email count sent once',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMailingUsers()
    {
        return $this->hasMany(MailingUsers::className(), ['mailing_id' => 'id']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            if( $this->isNewRecord ){

                $this->created_at = date("Y-m-d H:i:s");
                $this->paused = 1;
                $this->finished = 0;

            }

            $this->start_at = \common\components\Format::date( $this->start_at, 'm/d/Y', 'Y-m-d' );

            return true;
        } else {
            return false;
        }
    }

    public function afterFind()
    {
        $this->start_at = \common\components\Format::date( $this->start_at, 'Y-m-d', 'm/d/Y' );

        parent::afterFind();
    }

    public static function send(){

        $mailing_where = " UNIX_TIMESTAMP(`start_at`)<=UNIX_TIMESTAMP('".date("Y-m-d H:i:s")."') ";
        $mailing_where .= " AND ( ( ( UNIX_TIMESTAMP(`last_at`) + `frequency` )<=UNIX_TIMESTAMP('".date("Y-m-d H:i:s")."') ) OR `last_at` IS NULL ) ";
        $mailing_where .= " AND `finished` = 0 ";
        $mailing_where .= " AND `paused` = 0 ";

        if( $mailings = Mailing::find()->where($mailing_where)->orderBy("rand()")->all() ){

            foreach( $mailings as $mailing ){

                if( $mailing_users = MailingUsers::find()->where("`sent`=0 AND `mailing_id`=".$mailing->id)->limit( $mailing->email_count )->all() ){

                    foreach( $mailing_users as $mailing_user ){

                        if( $user = Users::find()->where("`id`=".$mailing_user->user_id)->one() ){

                            if( self::sendEmail( $user, $mailing ) ){

                                $mailing_user->sent = 1;
                                $mailing_user->sent_date = date("Y-m-d H:i:s");

                                $mailing_user->save( false );

                                $mailing->last_at = date("Y-m-d H:i:s");

                                $mailing->save( false );

                            }

                        } else {

                            $mailing_user->delete();

                        }

                    }

                } else {

                    if( $mailing->final_notification == 1 ){

                        $mailing->sendFinalNotification();

                    }

                    $mailing->finished = 1;

                    $mailing->save( false );

                }

            }

        }

        return true;

    }

    public static function sendEmail( $user, $mailing ){

        $layout_id = \Yii::$app->params["mailing_email_layout_id"];

        $from_name = $mailing->from_name;
        $from_email = $mailing->from_email;
        $to_name = '';
        $to_email = $user->email;
        $subject = $mailing->subject;
        $content = Email::renderFromText( $mailing->message, $layout_id, self::emailParams( $user, $mailing ) );
        $attachments = [];

        if( Email::send( $from_name, $from_email, $to_name, $to_email, $subject, $content, $attachments ) ){

            return true;

        }

        return false;

    }

    public function sendFinalNotification(){

        return true;

        $template_id = \Yii::$app->params["mailing_final_notify_template_id"];

        $to_name = $this->from_name;
        $to_email = $this->from_email;

        if( Email::sendByTemplate( $template_id, $to_name, $to_email ) ){

            return true;

        }

        return false;

    }

    public static function emailParams($user, $mailing){

        $params = [];

        $prms = self::emailParamsInfo( $user, $mailing );

        foreach( $prms as $prm ){

            $params[ $prm["key"] ] = $prm["value"];

        }

        return $params;

    }

    public static function emailParamsInfo($user, $mailing){


        $params = [
            [
                "key" => "user_email",
                "value" => $user->email,
                "label" => "User email",
            ]
        ];

        return $params;

    }
}
