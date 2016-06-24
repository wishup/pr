<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "contact_form".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $subject
 * @property string $email
 * @property string $message
 * @property string $date
 */
class ContactForm extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contact_form';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['message'], 'string'],
            [['date'], 'safe'],
            [['first_name', 'last_name', 'subject', 'email'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'subject' => 'Subject',
            'email' => 'Email',
            'message' => 'Message',
            'date' => 'Date',
        ];
    }
}
