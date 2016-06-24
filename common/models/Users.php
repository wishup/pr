<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $email
 * @property string $password
 * @property string $created_at
 * @property string $updated_at
 * @property integer $status
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'password', 'created_at', 'updated_at', 'status'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['status'], 'integer'],
            [['email'], 'string', 'max' => 255],
            [['password'], 'string', 'max' => 100],
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
            'password' => 'Password',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            // Place your custom code here

            $this->updated_at = date("Y-m-d H:i:s");


            return true;
        } else {
            return false;
        }
    }

    public static function restorePassword( $email ){

        if( $email ) {

            if ($user = Users::find()->where("(email='".$email."' or users.id=(SELECT `user_id` FROM `users_emails` WHERE `email`='".$email."'))")->one()) {
                if(!$token = UsersTokens::find()->where('user_id=:user_id and slug=:slug', array(':user_id'=>$user->id, ':slug' => 'password_reset'))->one()){
                    $token = new UsersTokens();
                    $token->user_id = $user->id;
                    $token->slug = 'password_reset';
                    $token->token = md5($email.time().rand(0, 100000000));
                    $token->save();
                }

                $url = Yii::$app->urlManager->createAbsoluteUrl('user/changepassword?token='.$token->token);

                self::sendRestoreEmail($user->id, $url, $email);

            } else
                throw new \Exception("Email is not registered.");

        } else
            throw new \Exception("Email cannot be blank.");

    }

    public static function sendRestoreEmail( $id, $url, $email ){

        if( $user = Users::find()->where("id=".$id)->one() ) {

            $emailparams = [
                "reset_url" => $url,
                "user_email" => $user->email,
                "user_first_name" => $user->userInfos->first_name,
                "user_last_name" => $user->userInfos->last_name,
            ];

            if( Email::sendByTemplate( Email::PASSWORD_RESTORE, '', $email, $emailparams ) )
                return true;
            else
                return false;

        } else
            return false;

    }

    public static function sendConfirmEmail( $id, $email ){

        if( $user = Users::find()->where("id=".$id)->one() ) {


            $template_slug = Email::ACCOUNT_CONFIRMATION;
            $emailparams = [
                "confirmation_url" => Yii::$app->params["domainUrl"] . 'user/confirm/?email=' . $user->email . '&token=' . $user->confirm_code,
            ];


            if( Email::sendByTemplate( $template_slug, '', $email, $emailparams ) )
                return true;
            else
                return false;

        } else
            return false;

    }

    public static function check_confirm_code( $email, $token ){

        if( $user = Users::find()->where("email='".$email."' AND confirm_code='".$token."'")->one() ){

            return $user->id;

        } else
            return false;

    }

    public static function confirm_account( $email, $token ){

        if( $user = Users::find()->where("email='".$email."' AND confirm_code='".$token."' AND status=0")->one() ){

            $user->status = 1;

            $user->save( false );

            return $user->id;

        } else
            return false;

    }

    public static function loginAs( $user_id ){

        $session = Yii::$app->session;

        $session["user_id"] = $user_id;

        return true;

    }

    public static function login( $email, $password ){

        $email = trim( $email );

        if( $user = Users::find()->where("(email='".$email."' or users.id=(SELECT `user_id` FROM `users_emails` WHERE `email`='".$email."')) AND password='".md5($password)."'")->one() ){

            if( $user->status == 1 ){

                self::loginAs( $user->id );

                $session = Yii::$app->session;

                if( isset( $session['connect_to_host'] ) ){

                    if( $family = UsersFamilies::find()->where("user_id=".self::getUserID( $user->id ))->one() ){

                        self::joinHost($session['connect_to_host']);

                        unset( $session['connect_to_host'] );

                    }

                }

                return true;

            } else{

                switch( $user->status ){

                    case 0:
                        throw new \Exception("Account is not confirmed.");
                        break;

                    case 2:
                        throw new \Exception("Account is blocked.");
                        break;

                }

            }

        } else
            throw new \Exception("Email/password is incorrect.");

    }

    public static function user_id(){

        $session = \Yii::$app->session;

        $user_id = ( isset($session["user_id"]) && self::activeUser($session["user_id"]) ) ? $session["user_id"] : false;

        return $user_id;

    }

    public static function activeUser( $user_id ){

        if( Users::find()->where("id=".(int)$user_id)->one() )
            return true;
        else {
            self::logout(true);
            return false;
        }

    }

    public static function logout(){

        $session = Yii::$app->session;

        unset( $session["user_id"] );

        return true;

    }
}
