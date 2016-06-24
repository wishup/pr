<?php
namespace frontend\models;

use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class ContactForm extends Model
{
    public $subject;
    public $first_name;
    public $last_name;
    public $email;
    public $message;
    public $captcha;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subject', 'first_name', 'last_name', 'email', 'message', 'captcha'], 'required'],
            ["captcha", "captcha"],
            ["email", "email"],
        ];
    }

    public function attributeLabels()
    {
        return [
            'captcha' => 'Captcha Code',
        ];
    }
}
