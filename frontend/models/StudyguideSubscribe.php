<?php
namespace frontend\models;

use common\models\Subscribers;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class StudyguideSubscribe extends Model
{
    public $email;
    public $first_name;
    public $last_name;
    public $address;
    public $city;
    public $state;
    public $zip;
    public $phone;

    const SCENARIO_ONLYEMAIL = 'onlyemail';
    const SCENARIO_MAIN = 'main';

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email'], 'required'],
            [['first_name', 'last_name'], 'required'],
            ["email", "email"],
            ["email", "checkAlreadyReged"],
        ];
    }

    public function scenarios()
    {
        return [
            self::SCENARIO_ONLYEMAIL => ['email'],
            self::SCENARIO_MAIN => ['email', 'first_name', 'last_name'],
        ];
    }

    public function checkAlreadyReged($attribute, $params)
    {

        if ( Subscribers::find()->where("email='".$this->email."' and slug='studyguide'")->one() ) {
            $this->addError($attribute, 'Email is already subscribed.');
        }
    }

    public function attributeLabels()
    {
        return [

        ];
    }
}
