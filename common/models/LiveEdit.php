<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "live_edit".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $token
 * @property string $date
 * @property string $model
 * @property integer $model_id
 * @property string $field
 *
 * @property User $user
 */
class LiveEdit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'live_edit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'model_id'], 'integer'],
            [['date'], 'safe'],
            [['token', 'model', 'field', 'encoded', 'index'], 'string', 'max' => 100]
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
            'token' => 'Token',
            'date' => 'Date',
            'model' => 'Model',
            'model_id' => 'Model ID',
            'field' => 'Field',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
