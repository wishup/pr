<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "messaging".
 *
 * @property integer $id
 * @property string $title
 * @property string $message
 * @property string $start_at
 * @property string $finish_at
 * @property integer $can_close
 *
 * @property MessagingUsers[] $messagingUsers
 */
class Messaging extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'messaging';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['message', 'title'], 'required'],
            [['message'], 'string'],
            [['start_at', 'finish_at'], 'safe'],
            [['can_close'], 'integer'],
            [['title'], 'string', 'max' => 300]
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
            'message' => 'Message',
            'start_at' => 'Start At',
            'finish_at' => 'Finish At',
            'can_close' => 'Can Close',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessagingUsers()
    {
        return $this->hasMany(MessagingUsers::className(), ['message_id' => 'id']);
    }

    public function beforeSave($insert)
    {
        if ($parentbs = parent::beforeSave($insert)) {
            // Place your custom code here


            $this->start_at = \common\components\Format::date( $this->start_at, 'm/d/Y', 'Y-m-d' );
            $this->finish_at = \common\components\Format::date( $this->finish_at, 'm/d/Y', 'Y-m-d' );


            return $parentbs;
        } else {
            return false;
        }
    }

    public function afterFind()
    {
        $this->start_at = \common\components\Format::date( $this->start_at, 'Y-m-d', 'm/d/Y' );
        $this->finish_at = \common\components\Format::date( $this->finish_at, 'Y-m-d', 'm/d/Y' );


        parent::afterFind();
    }

    public static function getMessages( $user_id ){

        $messages = self::find()->where(" (UNIX_TIMESTAMP('".date("Y-m-d H:i:s")."')>=UNIX_TIMESTAMP(`messaging`.`start_at`) OR `messaging`.`start_at` IS NULL OR `messaging`.`start_at`='') AND (UNIX_TIMESTAMP('".date("Y-m-d H:i:s")."')<=UNIX_TIMESTAMP(`messaging`.`finish_at`) OR `messaging`.`finish_at` IS NULL OR `messaging`.`finish_at`='') AND `messaging`.`id` IN (SELECT `messaging_users`.`message_id` FROM `messaging_users` WHERE `messaging_users`.`user_id`=".$user_id." AND `messaging_users`.`closed`=0)")->all();

        return $messages;

    }
}
