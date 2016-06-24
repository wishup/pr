<?php
namespace frontend\models;

use common\models\Users;
use mdm\admin\models\searchs\User;
use Yii;
use yii\base\Model;
use frontend\models\Login;

class PasswordForm extends Model{
    public $oldpass;
    public $newpass;
    public $repeatnewpass;

    const SCENAIO_PASSWORD_CHANGE = 'password_change';
    const SCENAIO_PASSWORD_RESET = 'password_reset';

    public function rules(){
        return [
            [['newpass', 'repeatnewpass'], 'string', 'min' => 6],
            [['newpass','repeatnewpass'],'required', 'on'=>[self::SCENAIO_PASSWORD_CHANGE, self::SCENAIO_PASSWORD_RESET]],
            [['oldpass'],'required', 'on'=>self::SCENAIO_PASSWORD_CHANGE],
            ['oldpass','findPasswords'],
            ['repeatnewpass','compare','compareAttribute'=>'newpass'],
        ];
    }

    public function findPasswords($attribute, $params){
        $user = Users::find()->where([
            'id'=>Yii::$app->session['user_id']
        ])->one();
        $password = $user->password;
        if($password!=md5($this->oldpass))
            $this->addError($attribute,'Old password is incorrect');
    }

    public function attributeLabels(){
        return [
            'oldpass'=>'Old Password',
            'newpass'=>'New Password',
            'repeatnewpass'=>'Repeat New Password',
        ];
    }
}