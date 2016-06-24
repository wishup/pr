<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_profile_history".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $date
 * @property string $fields
 * @property string $type
 *
 * @property Users $user
 */
class UserProfileHistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_profile_history';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'date', 'fields'], 'required'],
            [['user_id'], 'integer'],
            [['date'], 'safe'],
            [['fields', 'type'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'date' => 'Date',
            'fields' => 'Fields',
            'type' => 'Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }
}
