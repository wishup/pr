<?php

namespace common\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "emails".
 *
 * @property integer $id
 * @property string $from_name
 * @property string $from_email
 * @property string $to_name
 * @property string $to_email
 * @property string $subject
 * @property string $content
 * @property string $attachments
 * @property string $hash
 * @property integer $priority
 * @property string $status
 * @property string $send_date
 * @property string $created_at
 * @property string $sent_at
 */
class Emails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'emails';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['from_name', 'from_email', 'to_name', 'to_email', 'subject', 'content', 'priority'], 'required'],
            [['content'], 'string'],
            [['priority'], 'integer'],
            [['send_date', 'created_at', 'sent_at', 'attachments'], 'safe'],
            [['from_name', 'from_email', 'to_name', 'to_email'], 'string', 'max' => 150],
            [['subject'], 'string', 'max' => 300],
            [['hash'], 'string', 'max' => 50],
            [['status'], 'string', 'max' => 30],
            [['from_email', 'to_email'], 'email'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'from_name' => 'From Name',
            'from_email' => 'From Email',
            'to_name' => 'To Name',
            'to_email' => 'To Email',
            'subject' => 'Subject',
            'content' => 'Content',
            'attachments' => 'Attachments',
            'hash' => 'Hash',
            'priority' => 'Priority',
            'status' => 'Status',
            'send_date' => 'Send On',
            'created_at' => 'Created At',
            'sent_at' => 'Sent At',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            // Place your custom code here

            if( $this->isNewRecord ) {
                $this->created_at = date("Y-m-d H:i:s");
                $this->hash = $this->getEmailHash();
                $this->status = "outbox";
            }

            $this->send_date = \common\components\Format::date( $this->send_date, 'm/d/Y', 'Y-m-d' );
            $this->created_at = \common\components\Format::date( $this->created_at, 'm/d/Y H:i:s', 'Y-m-d H:i:s' );
            $this->sent_at = \common\components\Format::date( $this->sent_at, 'm/d/Y H:i:s', 'Y-m-d H:i:s' );


            return true;
        } else {
            return false;
        }
    }

    public function getEmailHash(){

        return md5( "content=".$this->content."subject=".$this->subject."&from=".$this->from_name.$this->from_email."&to=".$this->to_name.$this->to_email."&send_date=".$this->send_date );

    }

    public function afterFind()
    {
        $this->send_date = \common\components\Format::date( $this->send_date, 'Y-m-d', 'm/d/Y' );
        $this->created_at = \common\components\Format::date( $this->created_at, 'Y-m-d H:i:s', 'm/d/Y H:i:s' );
        $this->sent_at = \common\components\Format::date( $this->sent_at, 'Y-m-d H:i:s', 'm/d/Y H:i:s' );

        parent::afterFind();
    }

    public function search($params)
    {
        $query = self::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params))) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'from_email', $this->from_email]);
        $query->andFilterWhere(['like', 'to_email', $this->to_email]);
        $query->andFilterWhere(['like', 'subject', $this->subject]);
        $query->andFilterWhere(['like', 'status', $this->status]);
        $query->andFilterWhere(['like', 'created_at', $this->created_at]);
        $query->andFilterWhere(['like', 'sent_at', $this->sent_at]);
        $query->andFilterWhere(['like', 'priority', $this->priority]);

        return $dataProvider;
    }
}
