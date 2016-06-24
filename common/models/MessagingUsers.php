<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "messaging_users".
 *
 * @property integer $id
 * @property integer $message_id
 * @property integer $user_id
 * @property string $viewed_at
 * @property integer $closed
 *
 * @property Messaging $message
 * @property Users $user
 */
class MessagingUsers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'messaging_users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['message_id', 'user_id', 'closed'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'message_id' => 'Message ID',
            'user_id' => 'User ID',
            'viewed_at' => 'Viewed At',
            'closed' => 'Closed',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessage()
    {
        return $this->hasOne(Messaging::className(), ['id' => 'message_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }
}
