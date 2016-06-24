<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mailing_templates".
 *
 * @property integer $id
 * @property string $title
 * @property string $message
 */
class MailingTemplates extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mailing_templates';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['message', 'title'], 'required'],
            [['message'], 'string'],
            [['title'], 'string', 'max' => 200]
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
        ];
    }
}
