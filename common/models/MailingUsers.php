<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mailing_users".
 *
 * @property integer $id
 * @property integer $mailing_id
 * @property integer $user_id
 * @property integer $sent
 * @property string $sent_date
 *
 * @property Mailing $mailing
 * @property Users $user
 */
class MailingUsers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mailing_users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mailing_id', 'user_id', 'sent'], 'integer'],
            [['sent_date'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'mailing_id' => 'Mailing ID',
            'user_id' => 'User ID',
            'sent' => 'Sent',
            'sent_date' => 'Sent Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMailing()
    {
        return $this->hasOne(Mailing::className(), ['id' => 'mailing_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }
}
