<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "settings".
 *
 * @property string $facebook_api_key
 * @property string $facebook_api_secret_key
 */
class Settings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'settings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['facebook_api_key', 'facebook_api_secret_key','facebook_link','twitter_link'], 'string', 'max' => 100],
            [['notification_email_bcc'], 'check_bcc'],
            [['notification_email'], 'email'],
            [['footer_copyrights', 'google_analytics'], 'safe'],
            [['favicon'], 'file'],
        ];
    }

    public function check_bcc($attribute, $params)
    {

        $emails = explode("," , $this->$attribute);

        foreach( $emails as $email ) {

            if (!filter_var(trim($email), FILTER_VALIDATE_EMAIL)) {

                $this->addError($attribute, Yii::t('app', 'You entered an invalid email format.'));

                break;

            }

        }

    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'facebook_api_key' => 'Facebook Api Key',
            'facebook_api_secret_key' => 'Facebook Api Secret Key',
            'facebook_link' => 'Facebook Page Link',
            'twitter_link' => 'Twitter Page Link',
            'footer_copyrights' => 'Footer Copyrights text',
            'favicon' => 'Favicon',
            'google_analytics' => 'Google Analytics Code',
            'notification_email' => 'Notifications email',
            'notification_email_bcc' => 'Notifications email bcc (separate with comma)',
        ];
    }
}
