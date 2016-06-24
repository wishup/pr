<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "unsubscribe".
 *
 * @property integer $id
 * @property string $email
 * @property integer $group_id
 */
class Unsubscribe extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'unsubscribe';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_id', 'reason_id'], 'integer'],
            [['email'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'group_id' => 'Group',
        ];
    }
}
