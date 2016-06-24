<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "email_groups".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $unsubscribe
 */
class EmailGroups extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'email_groups';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['description'], 'string'],
            [['unsubscribe'], 'integer'],
            [['title'], 'string', 'max' => 200],
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
            'description' => 'Description',
            'unsubscribe' => 'Unsubscribe',
        ];
    }
}
