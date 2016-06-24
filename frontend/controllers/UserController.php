<?php
namespace frontend\controllers;

use common\components\widgets\Social;
use common\models\Contestants;
use common\models\Discount;
use common\models\FamilyHost;
use common\models\FamilyPayment;
use common\models\Order;
use common\models\OrderItem;
use common\models\Seasons;
use common\models\User;
use common\models\UsersEmails;
use common\models\UsersFamilies;
use common\models\UsersHosts;
use common\models\UserCheck;
use common\models\HearAbout;
use frontend\models\PasswordForm;
use mdm\admin\models\form\Login;
use Yii;
use frontend\controllers\BaseController;
use yii\helpers\Url;
use yii\web\Session;
use common\models\Users;
use common\models\SocialAuth;
use common\models\UserInfo;
use common\models\UsersTokens;
use common\models\Options;
use yii\web\UploadedFile;
use common\components\attachments;
use common\components\Email;

/**
 * Site controller
 */
class UserController extends BaseController
{

    public function actions()
    {
        return [
            'fbauth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'onAuthSuccess'],
            ],
            'hfbauth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'onAuthSuccessHost'],
            ],
            'gauth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'onGoogleAuthSuccess'],
            ],
            'hgauth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'onGoogleAuthSuccessHost'],
            ],
        ];
    }

    public function actionLogin(){

        $current_user_id = \common\models\Users::user_id();

        if( $current_user_id && !Yii::$app->request->isPost ) return $this->goHome();

        // Get started
        if( Yii::$app->request->post("get_started") ){

            try {
                $user_id = Users::getStarted( Yii::$app->request->post("email"));

                if( $user_id == $current_user_id ){

                    echo 2; exit;

                } else {

                    Users::sendConfirmEmail($user_id, Yii::$app->request->post("email"));

                    if( Yii::$app->request->isAjax ){ echo 1; exit; } else return $this->redirect('/account-confirmation');

                }

            } catch(\Exception $e) {

                if( Yii::$app->request->isAjax ){

                    echo $e->getMessage(); exit;

                } else {

                    Yii::$app->getSession()->setFlash('error', [
                        Yii::t('app', $e->getMessage()),
                    ]);

                }

            }

        }

        //Authorization
        if( Yii::$app->request->post("auth") ){

            try {

                Users::login( Yii::$app->request->post("email"), Yii::$app->request->post("password") );

                if( Yii::$app->request->isAjax ){ echo 1; exit; } else return $this->redirect("/dashboard");

            } catch(\Exception $e) {

                if( Yii::$app->request->isAjax ){

                    echo $e->getMessage(); exit;

                } else {

                    Yii::$app->getSession()->setFlash('error', [
                        Yii::t('app', $e->getMessage()),
                    ]);

                }
            }

        }

        $this->layout = 'login';
        $this->view->params['bodyClass'] = 'layout2';
        return $this->render("login", [

        ]);

    }

    public function actionForgot(){

        if( $user_id = Users::user_id() ) return $this->goHome();

        if( Yii::$app->request->post("forgot_pass") ){

            $return = [];

            try {

                Users::restorePassword( Yii::$app->request->post("email") );

                $return["response"] = "ok";

            } catch(\Exception $e) {

                $return["response"] = "error";
                $return["errors"] = ["email"=>[$e->getMessage()]];

            }

            echo json_encode( $return );
            exit;

        }

        $this->layout = 'login';
        $this->view->params['bodyClass'] = 'layout2';
        return $this->render("forgot", [

        ]);

    }

    public function actionChangepassword(){

        $model = new PasswordForm();
        $session = Yii::$app->session;
        $token = Yii::$app->request->get("token");

        if($token and $token_model = UsersTokens::find()->where("slug=:slug and token=:token", array(':slug'=>'password_reset', ':token' => $token))->one()){
            $user_id = $token_model->user_id;
            $model->scenario = PasswordForm::SCENAIO_PASSWORD_RESET;
        } elseif($user_id = Users::user_id()){
            $model->scenario = PasswordForm::SCENAIO_PASSWORD_CHANGE;
        } else{
            $this->redirect('/404');
        }


        $modeluser = Users::find()->where(['id'=>$user_id])->one();

        if($model->load(Yii::$app->request->post())){
            if($model->validate()){
                    $modeluser->password = md5($_POST['PasswordForm']['newpass']);
                    if($modeluser->save()){
                        if($token and $token_model){
                            $token_model->delete();
                        }
                        Users::loginAs($modeluser->id);
                        return $this->redirect(Url::toRoute('dashboard'));
                    }
            }
        }

        if(Users::user_id()){

            $user_dyn_id = \common\models\Users::getUserID( $user_id );

            $usermodel = Users::find()->where("`id`=".$user_id)->one();
            $infomodel = UserInfo::find()->where("`user_id`=".$user_id)->one();

            if( !$hostmodel = UsersHosts::find()->where("`user_id`=".$user_dyn_id)->one() )
                $hostmodel = new UsersHosts();

            $hostmodel->user_id = $user_dyn_id;

            if( !$bgcheckmodel = UserCheck::find()->where("`user_id`=".$user_dyn_id)->one() )
                $bgcheckmodel = new UserCheck();

            $bgcheckmodel->user_id = $user_dyn_id;

            $family = UsersFamilies::find()->where("user_id=".$user_dyn_id." AND status=1")->one();

            $additional_email = new UsersEmails();

            $additional_email->user_id = $usermodel->id;

            if( $additional_email->load(Yii::$app->request->post()) && $additional_email->save() ){

                $additional_email = new UsersEmails();

            }

            $this->view->params['bodyClass'] = 'account-dashboard';
            $this->view->params['bodyClassDefault'] = false;

            return $this->render('changepassword',[
                'model'=>$model,
                "usermodel" => $usermodel,
                "infomodel" => $infomodel,
                "hostmodel" => $hostmodel,
                "bgcheckmodel" => $bgcheckmodel,
                "family" => $family,
                "children" => isset($children) ? $children : false,
                'additional_email' => $additional_email,

            ]);
        } else {
            $this->layout = 'login';
            $this->view->params['bodyClass'] = 'layout2';
            return $this->render('resetpassword',[
                'model'=>$model
            ]);
        }


    }

    public function actionDeladditemail( $id ){

        if($user_id = Users::user_id()){

            if( $additemail = UsersEmails::find()->where("id=".$id." and user_id=".$user_id)->one() ){

                $additemail->delete();

            }

        }

        return $this->redirect($_SERVER["HTTP_REFERER"].'#additemail');

    }

    public function actionAdditemailprimary( $id ){

        if($user_id = Users::user_id()){

            if( $additemail = UsersEmails::find()->where("id=".$id." and user_id=".$user_id)->one() ){

                $usermodel = Users::find()->where("id=".$user_id)->one();

                $primary_email = $additemail->email;
                $new_addit_email = $usermodel->email;

                $usermodel->email = $primary_email;

                $usermodel->save();

                $additemail->email = $new_addit_email;

                $additemail->save();

            }

        }

        return $this->redirect($_SERVER["HTTP_REFERER"].'#additemail');

    }

    public function actionConfirm(){

        if( Yii::$app->request->get("email") && Yii::$app->request->get("token") ){

            $email = Yii::$app->request->get("email");
            $token = Yii::$app->request->get("token");

            if( $user_id = Users::check_confirm_code( $email, $token ) ){

                //Users::loginAs( $user_id );

                $session = Yii::$app->session;

                $session["finish_registration"] = 1;

                if( !$uht_model = UsersTokens::find()->where("user_id=".$user_id." and slug='user_host'")->one() ) {

                    $user_host_token = md5( $user_id.time().rand(0,100000) );

                    $uht_model = new UsersTokens();

                    $uht_model->user_id = $user_id;
                    $uht_model->slug = 'user_host';
                    $uht_model->token = $user_host_token;

                    $uht_model->save();

                } else {

                    $user_host_token = $uht_model->token;

                }

                if(Yii::$app->request->get("family")){
                    return $this->redirect('/user/familyregistration/'.$user_id.'?token='.$user_host_token);
                } else {
                    return $this->redirect('/user/renewhost/'.$user_id.'?token='.$user_host_token);
                }


            }

        }

        $exception = new \Exception();
        $exception->statusCode = '111';

        return $this->render('//site/error', ["name" => "Incorrect confirmation link", "message"=>"The link for activation is incorrect or was used before.", "exception" => $exception]);


    }

    public function actionRegistration(){

        $session = Yii::$app->session;

        if( !($user_id = Users::user_id()) || !isset($session["finish_registration"]) ) return $this->goHome();

        $errors = [];

        // Get started
        if( Yii::$app->request->post("reg") ){

            $first_name = Yii::$app->request->post("first_name");
            $last_name = Yii::$app->request->post("last_name");
            $password = Yii::$app->request->post("password");
            $password_confirm = Yii::$app->request->post("password_confirm");

            $errors = Users::finish_registration( $user_id, $first_name, $last_name, $password, $password_confirm );

            if( count($errors) == 0 ) return $this->goHome();

        }

        $this->layout = 'login';
        $this->view->params['bodyClass'] = 'registration';
        return $this->render("registration", [
            "errors" => $errors
        ]);

    }

    public function actionLogout(){

        Users::logout();

        return $this->goHome();

    }

    public function onAuthSuccess($client)
    {
        $attributes = $client->getUserAttributes();

        /* @var $auth Auth */
        $auth = SocialAuth::find()->where([
            'source' => $client->getId(),
            'source_id' => $attributes['id'],
        ])->one();

        if ( !$user_id = Users::user_id() ) {
            if ($auth) { // login

                $canLogin = false;

                if( $usermodel = Users::find()->where("id=".$auth->user_id)->one() ){

                    if( $usermodel->status == 1 ){

                        $canLogin = true;

                    }

                }

                if( $canLogin ) {

                    $user_id = $auth->user_id;
                    Users::loginAs($user_id);

                    return $this->goHome();

                } else {
                    return $this->redirect("/user/login?fbloginerr");
                }
            } else {

                return $this->redirect("/user/login?fbloginerr");

            }
        } else { // user already logged in
            if (!$auth) { // add auth provider
                $auth = new SocialAuth([
                    'user_id' => $user_id,
                    'source' => $client->getId(),
                    'source_id' => $attributes['id'],
                ]);

                $auth->save();

                $user_info = UserInfo::find()->where("user_id=".$user_id)->one();

                $user_info->first_name = $attributes["first_name"];
                $user_info->last_name = $attributes["last_name"];

                $user_info->save( false );
            }
        }
    }

    public function onAuthSuccessHost($client)
    {
        $attributes = $client->getUserAttributes();

        if( !SocialAuth::find()->where("source='facebook' and source_id='".$attributes["id"]."'")->one() ) {

            $session = Yii::$app->session;

            $fbkey = md5(time() . rand(0, 10000));

            $session['host_renew_fb_' . $fbkey] = $attributes["id"];

            $status = 'success';

        } else {

            $fbkey = '';
            $status = 'used';

        }

        ?>
        <script>
            var profile_info = new Array();
            profile_info['status'] = "<?= $status ?>";
            profile_info['fbkey'] = "<?= $fbkey ?>";
            <?php
            foreach( $attributes as $ind=>$attr ){

                switch( $ind ){

                    case "picture":
                        echo 'profile_info[\''.$ind.'\'] = "'.( isset($attr["data"]["url"]) ? $attr["data"]["url"] : '' ).'";';
                        break;

                    default:
                        echo 'profile_info[\''.$ind.'\'] = "'.$attr.'";';
                        break;

                }

            }
            ?>
            window.opener.renew_host_fb_login( profile_info );
            window.close();
        </script>
        <?php

        exit;
    }

    public function onGoogleAuthSuccessHost($client)
    {

        $attributes = $client->getUserAttributes();
        $email_is_used = 0;

        if( $socauth = SocialAuth::find()->where("source='google' and source_id='".$attributes["id"]."'")->one() ){


            $umodel = Users::find()->where("id=".$socauth->user_id)->one();

            if( $umodel->status == 0 ){

                $socauth->delete();

                $accountused = false;
            } else {
                $accountused = true;
            }

        } else {

            $accountused = false;
        }

        if( !$accountused ) {

            $session = Yii::$app->session;

            $fbkey = md5(time() . rand(0, 10000));

            $session['host_renew_g_' . $fbkey] = $attributes["id"];

            $status = 'success';

            $email = $attributes["emails"]["0"]["value"];

            if($existinguser = Users::find()->where("`email`='".$email."'")->one()  and $existinguser->status != 0){
                $email_is_used = 1;
            }

        } else {

            $fbkey = '';
            $status = 'used';

        }

        ?>
        <script>
            var profile_info = new Array();
            profile_info['status'] = "<?= $status ?>";
            profile_info['fbkey'] = "<?= $fbkey ?>";
            profile_info['picture'] = "<?= isset($attributes["image"]["url"]) ? $attributes["image"]["url"] : '' ?>";
            profile_info['first_name'] = "<?= isset($attributes["name"]["givenName"]) ? $attributes["name"]["givenName"] : '' ?>";
            profile_info['last_name'] = "<?= isset($attributes["name"]["familyName"]) ? $attributes["name"]["familyName"] : '' ?>";
            profile_info['email'] = "<?= isset($attributes["emails"]["0"]["value"]) ? $attributes["emails"]["0"]["value"] : '' ?>";
            profile_info['email_is_used'] = "<?= $email_is_used ?>";

            window.opener.renew_host_g_login( profile_info );
            window.close();
        </script>
        <?php

        exit;
    }


    public function onGoogleAuthSuccessFamily($client)
    {

        $attributes = $client->getUserAttributes();

        if( $socauth = SocialAuth::find()->where("source='google' and source_id='".$attributes["id"]."'")->one() ){


            $umodel = Users::find()->where("id=".$socauth->user_id)->one();

            if( $umodel->status == 0 ){

                $socauth->delete();

                $accountused = false;
            } else {
                $accountused = true;
            }

        } else {
            $accountused = false;
        }

        if( !$accountused ) {

            $session = Yii::$app->session;

            $fbkey = md5(time() . rand(0, 10000));

            $session['family_g_' . $fbkey] = $attributes["id"];

            $status = 'success';

        } else {

            $fbkey = '';
            $status = 'used';

        }

        ?>
        <script>
            var profile_info = new Array();
            profile_info['status'] = "<?= $status ?>";
            profile_info['fbkey'] = "<?= $fbkey ?>";
            profile_info['picture'] = "<?= isset($attributes["image"]["url"]) ? $attributes["image"]["url"] : '' ?>";
            profile_info['first_name'] = "<?= isset($attributes["name"]["givenName"]) ? $attributes["name"]["givenName"] : '' ?>";
            profile_info['last_name'] = "<?= isset($attributes["name"]["familyName"]) ? $attributes["name"]["familyName"] : '' ?>";
            profile_info['email'] = "<?= isset($attributes["emails"]["0"]["value"]) ? $attributes["emails"]["0"]["value"] : '' ?>";

            window.opener.family_g_login( profile_info );
            window.close();
        </script>
        <?php

        exit;
    }
    public function onGoogleAuthSuccess($client)
    {
        $attributes = $client->getUserAttributes();

        /* @var $auth Auth */
        $auth = SocialAuth::find()->where([
            'source' => $client->getId(),
            'source_id' => $attributes['id'],
        ])->one();

        if ( !$user_id = Users::user_id() ) {
            if ($auth) { // login
                $canLogin = false;

                if( $usermodel = Users::find()->where("id=".$auth->user_id)->one() ){

                    if( $usermodel->status == 1 ){

                        $canLogin = true;

                    }

                }

                if( $canLogin ) {

                    $user_id = $auth->user_id;
                    Users::loginAs($user_id);

                    return $this->goHome();

                } else {
                    return $this->redirect("/user/login?fbloginerr");
                }
            } else {

                return $this->redirect("/user/login?fbloginerr");

            }
        } else { // user already logged in
            if (!$auth) { // add auth provider
                $auth = new SocialAuth([
                    'user_id' => $user_id,
                    'source' => $client->getId(),
                    'source_id' => $attributes['id'],
                ]);

                $auth->save();

                $user_info = UserInfo::find()->where("user_id=".$user_id)->one();

                $user_info->first_name = $attributes["name"]["givenName"];
                $user_info->last_name = $attributes["name"]["familyName"];

                $user_info->save( false );
            }
        }
    }

    public function actionRenewhost($id = 0){

        $session = Yii::$app->session;

        $hear_about_arr = array('0'=>'Select One');

        if($hear_about = HearAbout::find()->all()){
            foreach($hear_about as $item):
                $hear_about_arr[$item->id] = $item->answer;
            endforeach;
        }
        $hear_about_arr['999999'] = 'Other';

        $is_verification_page = (Yii::$app->request->get("is_v") == 'false')? false:true;

        $current_user_id = Users::user_id();

        if( Yii::$app->request->get("token") || ( $id == 0 && $current_user_id ) ) {

            $user_token = UsersTokens::find()->where("user_id=".$id." and token='".Yii::$app->request->get("token")."'")->one();

            if( $user_token || ( $id == 0 && $current_user_id ) ) {

                $reg_user_id = ( $id == 0 && $current_user_id ) ? $current_user_id : $user_token->user_id;

                $success = 0;

                $user_dyn_id = Users::getUserID( $reg_user_id );

                $usermodel = Users::find()->where("id=".$reg_user_id)->one();
                $usermodel->scenario = 'renew';

                if( !$userinfomodel = UserInfo::find()->where("user_id=".$reg_user_id)->one() )
                    $userinfomodel = new UserInfo();

                $userinfomodel->scenario = UserInfo::SCENARIO_INFO;

                if( !$userhostmodel = UsersHosts::find()->where("user_id=".$user_dyn_id)->one() ){

                    $userhostmodel = new UsersHosts();

                    if( $previous_season = Seasons::getPrevious() ){

                        if( $user_prev_dyn_id = Users::getUserID( $reg_user_id, $previous_season->id ) ){

                            if( $userprevhostmodel = UsersHosts::find()->where("user_id=".$user_prev_dyn_id)->one() ){

                                $userhostmodel->attributes = $userprevhostmodel->attributes;

                                $userhostmodel->status = 0;

                            }

                        }

                    }

                }


                $userinfomodel->user_id = $reg_user_id;
                $userhostmodel->user_id = $user_dyn_id;

                if( Yii::$app->request->post() ){

                    $usermodel->password = Yii::$app->request->post("Users")["password"] != '' ? md5( Yii::$app->request->post("Users")["password"] ) : substr(md5(rand(0,1000).time()),0,8);

                    if( Yii::$app->request->post("fbkey") && isset( $session['host_renew_fb_'.Yii::$app->request->post("fbkey") ] ) ){

                        $socialauth = new SocialAuth();

                        $socialauth->user_id = $userinfomodel->user_id;
                        $socialauth->source = "facebook";
                        $socialauth->source_id = $session['host_renew_fb_'.Yii::$app->request->post("fbkey") ];

                        $socialauth->save();

                    }

                    if( Yii::$app->request->post("gkey") && isset( $session['host_renew_g_'.Yii::$app->request->post("gkey") ] ) ){

                        $socialauth = new SocialAuth();

                        $socialauth->user_id = $userinfomodel->user_id;
                        $socialauth->source = "google";
                        $socialauth->source_id = $session['host_renew_g_'.Yii::$app->request->post("gkey") ];

                        $socialauth->save();

                        if( Yii::$app->request->post("gavatar") ){

                            $avfile = md5(time().rand(0,1000)).'.jpg';

                            if( !file_exists( \Yii::getAlias('@frontend').'/web/upload/avatar/'.$userinfomodel->user_id.'/' ) )
                                mkdir(\Yii::getAlias('@frontend').'/web/upload/avatar/'.$userinfomodel->user_id.'/', 0777, true);

                            $gavatar = str_replace("sz=50", "sz=500", urldecode(Yii::$app->request->post("gavatar")));

                            if( $avatar_content = file_get_contents($gavatar) ){
                                $f = fopen(\Yii::getAlias('@frontend').'/web/upload/avatar/'.$userinfomodel->user_id.'/'.$avfile, "w");
                                fwrite($f, $avatar_content);
                                fclose($f);
                            }

                            $userinfomodel->avatar = $avfile;

                            $userinfomodel->save( false );
                        }

                    }

                    if ($userinfomodel->load(Yii::$app->request->post()) && $userinfomodel->save()) {



                        if (!$checkmodel = UserCheck::find()->where("user_id=" . $user_dyn_id)->one()){
                            $checkmodel = new UserCheck();

                            if( $previous_season = Seasons::getPrevious() ){

                                if( $user_prev_dyn_id = Users::getUserID( $reg_user_id, $previous_season->id ) ){

                                    if( $userprevcheckmodel = UserCheck::find()->where("user_id=".$user_prev_dyn_id)->one() ){

                                        if( $userprevcheckmodel->status == 'approved' ){
                                            $checkmodel->attributes = $userprevcheckmodel->attributes;
                                        }

                                    }

                                }

                            }

                            $checkmodel->user_id = $user_dyn_id;

                            $checkmodel->save( false );
                        }

                        $userhostmodel->summer_event_state = $userinfomodel->state;
                        $userhostmodel->summer_event_city = $userinfomodel->city;
                        $userhostmodel->summer_event_zip = $userinfomodel->zip;

                        $userhostmodel->willing_to_host = Yii::$app->request->post("UsersHosts")["willing_to_host"];

                        $userhostmodel->status = 0;
                        $userhostmodel->save( false );

                        $usermodel->status = 1; // Confirm account

                        $usermodel->save( false );

                        if( Yii::$app->request->post("agreement1") ){
                            Options::setOption("Users", $user_dyn_id, 'host_agreement', "agree" );
                            Options::setOption("Users", $user_dyn_id, 'statement_of_faith', "agree" );
                        }

                        if( Yii::$app->request->post("agreement_1_name") ){
                            Options::setOption("Users", $user_dyn_id, 'host_agreement_name', Yii::$app->request->post("agreement_1_name") );
                            Options::setOption("Users", $user_dyn_id, 'statement_of_faith_name', Yii::$app->request->post("agreement_1_name") );
                        }

                        $success = 1;

                    }

                }

                if( $success == 1 ){

                    Users::loginAs( $id );

                    Email::sendByTemplate( Email::HOST_REGISTRATON, $userinfomodel->first_name.' '.$userinfomodel->last_name, $usermodel->email, [] );

                    return $this->redirect("/dashboard");

                } else {

                    $this->view->params['bodyClass'] = 'layout2';

                    return $this->render("renewhost", [
                        "usermodel" => $usermodel,
                        "userinfomodel" => $userinfomodel,
                        "userhostmodel" => $userhostmodel,
                        "success" => $success,
                        'is_verification_page' => $is_verification_page,
                        'hear_about' => $hear_about_arr,
                    ]);

                }

            } else
                return $this->redirect("/404");

        } else
            return $this->redirect("/404");

    }

    public function actionFamilydirectregistration($id=Null){

        if (Yii::$app->request->isAjax && Yii::$app->request->post('ajax') === 'family-registration-form') {
            $errors = array();
            $users_data = Yii::$app->request->post('Users');
            if(isset($users_data['email']) and $email = $users_data['email'] and $existinguser = Users::find()->where("`email`='".$email."'")->one()){
                if($existinguser->status != 0){
                    $errors['users-email'][] = 'You already have an account with this email.';
                }
            }
            return json_encode($errors);
        }

        if($id and !Users::findOne($id)){
            return $this->redirect('user/familydirectregistration');
        }
        if(isset(Yii::$app->session['user_id'])){
            $id = Yii::$app->session['user_id'];
        }

        $success = 0;

        $session = Yii::$app->session;

        $hear_about_arr = array('0'=>'Select One');

        if($hear_about = HearAbout::find()->all()){
            foreach($hear_about as $item):
                $hear_about_arr[$item->id] = $item->answer;
            endforeach;
        }
        $hear_about_arr['999999'] = 'Other';

        $notBeginnerCount = 0;

        if($id){
            $user_dyn_id = Users::getUserID( $id );

            $usermodel = Users::find()->where("id=".$id)->one();
            $usermodel->scenario = 'renew';

            if( !$userinfomodel = UserInfo::find()->where("user_id=".$id)->one() )
                $userinfomodel = new UserInfo();

            $userinfomodel->scenario = 'family_direct';
            $contestantmodel = new \common\models\Contestants();
            if( !$usersfamiliesmodel = UsersFamilies::find()->where("user_id=".$user_dyn_id)->one()){
                $usersfamiliesmodel = new UsersFamilies();
                $usersfamiliesmodel->status = 0;
            }

            if($usersfamiliesmodel->status == 1){
                Yii::$app->getSession()->setFlash('success', 'You Are Already Registered!');
                return $this->redirect('user/dashboard');
            }

            $userinfomodel->user_id = $id;
            $usersfamiliesmodel->user_id = $user_dyn_id;

            if($usersfamiliesmodel->id) {
                $notBeginnerCount =  OrderItem::getOrderedNotBgChildrenCount($usersfamiliesmodel->id);
            }

        } else{

            $usermodel = new Users();
            if($prefill_email = Yii::$app->request->get('email', false)){
                $usermodel->email = $prefill_email;
            }
            $usermodel->scenario = 'renew';

            $userinfomodel = new UserInfo();
            $userinfomodel->scenario = 'family_direct';

            $contestantmodel = new \common\models\Contestants();
            $usersfamiliesmodel = new UsersFamilies();
            $usersfamiliesmodel->status = 0;
        }



        if( Yii::$app->request->post() ){
            if(!$id){
                $id = Users::getStarted(Yii::$app->request->post('Users')['email'], true);
            }
            $user_dyn_id = Users::getUserID( $id);
            if( !$usersfamiliesmodel = UsersFamilies::find()->where("user_id=".$user_dyn_id)->one()){
                $usersfamiliesmodel = new UsersFamilies();
                $usersfamiliesmodel->status = 0;
            }

            $usermodel = Users::find()->where("id=".$id)->one();
            $usermodel->scenario = 'renew';

            if( !$userinfomodel = UserInfo::find()->where("user_id=".$id)->one() )
                $userinfomodel = new UserInfo();

            $userinfomodel->user_id = $id;
            $usersfamiliesmodel->user_id = $user_dyn_id;

            $usermodel->password = Yii::$app->request->post("Users")["password"] != '' ? md5( Yii::$app->request->post("Users")["password"] ) : substr(md5(rand(0,1000).time()),0,8);

            if( Yii::$app->request->post("fbkey") && isset( $session['host_renew_fb_'.Yii::$app->request->post("fbkey") ] ) ){
                $socialauth = new SocialAuth();
                $socialauth->user_id = $userinfomodel->user_id;
                $socialauth->source = "facebook";
                $socialauth->source_id = $session['host_renew_fb_'.Yii::$app->request->post("fbkey") ];
                $socialauth->save();
            }

            if( Yii::$app->request->post("gkey") && isset( $session['host_renew_g_'.Yii::$app->request->post("gkey") ] ) ){

                $socialauth = new SocialAuth();

                $socialauth->user_id = $userinfomodel->user_id;
                $socialauth->source = "google";
                $socialauth->source_id = $session['host_renew_g_'.Yii::$app->request->post("gkey") ];

                $socialauth->save();

                if( Yii::$app->request->post("gavatar") ){

                    $avfile = md5(time().rand(0,1000)).'.jpg';

                    if( !file_exists( \Yii::getAlias('@frontend').'/web/upload/avatar/'.$userinfomodel->user_id.'/' ) )
                        mkdir(\Yii::getAlias('@frontend').'/web/upload/avatar/'.$userinfomodel->user_id.'/', 0777, true);

                    $gavatar = str_replace("sz=50", "sz=500", urldecode(Yii::$app->request->post("gavatar")));

                    if( $avatar_content = file_get_contents($gavatar) ){
                        $f = fopen(\Yii::getAlias('@frontend').'/web/upload/avatar/'.$userinfomodel->user_id.'/'.$avfile, "w");
                        fwrite($f, $avatar_content);
                        fclose($f);
                    }

                    $userinfomodel->avatar = $avfile;

                    $userinfomodel->save( false );
                }

            }

            if ($userinfomodel->load(Yii::$app->request->post()) && $userinfomodel->save()) {
                if($usersfamiliesmodel->id) {
                    if($usersfamiliesmodel->status == 0) {
                        $usersfamiliesmodel->delete();
                        $usersfamiliesmodel = new UsersFamilies();
                        $usersfamiliesmodel->status = 0;
                    } else {
                        Order::deleteAll("user_id  = :f_id AND status = 0", array(':f_id' => $usersfamiliesmodel->id));
                    }
                }
                $usersfamiliesmodel->load(Yii::$app->request->post());
                $usersfamiliesmodel->user_id = $user_dyn_id;
                $usersfamiliesmodel->save();

                $usermodel->save( false );

                $orderModel  = New Order();
                $orderModel->user_id = $usersfamiliesmodel->id;
                $orderModel->dyn_user_id = $user_dyn_id;
                $orderModel->first_name = $userinfomodel->first_name;
                $orderModel->last_name = $userinfomodel->last_name;
                $orderModel->discount = 0;
                $orderModel->subtotal = 0;
                $orderModel->final_price = 0;
                $orderModel->status = 0;
                $orderModel->save();

                $subtotal = 0;

                if(Yii::$app->request->post('Contestants')) {

                    foreach (Yii::$app->request->post('Contestants') as $Contestant) {
                        $ContestantModel = new \common\models\Contestants();
                        $ContestantModel->setAttributes($Contestant);
                        $ContestantModel->user_id = $usersfamiliesmodel->id;
                        $ContestantModel->order_id = $orderModel->id;
                        if ($ContestantModel->save()) {
                            if($ContestantModel->age_group != 'Beginner'){
                                $notBeginnerCount++;
                            }
                            $orderItemModel = new OrderItem();
                            $orderItemModel->order_id = $orderModel->id;
                            $orderItemModel->title = $ContestantModel->first_name;
                            $orderItemModel->description = $ContestantModel->age_group;
                            $orderItemModel->price = ($notBeginnerCount > 4 || $ContestantModel->age_group == 'Beginner')?5:25;
                            $orderItemModel->quantity = 1;
                            $orderItemModel->subtotal = $orderItemModel->price * $orderItemModel->quantity;
                            $orderItemModel->save();
                            $subtotal += $orderItemModel->subtotal;

                        }
                    }
                }
                $for_children_subtotal = $subtotal;

                if( Yii::$app->request->post("donate_count")  and Yii::$app->request->post("donate_agree") ){
                    Options::setOption("Users", $user_dyn_id, 'donate_agreement', "1" );

                    $orderItemModel = new OrderItem();
                    $orderItemModel->order_id  = $orderModel->id;
                    $orderItemModel->title = "Sponsoring";
                    $orderItemModel->price = 25;
                    $orderItemModel->quantity = Yii::$app->request->post("donate_count");
                    $orderItemModel->subtotal = $orderItemModel->price * $orderItemModel->quantity;
                    $orderItemModel->save();
                    $subtotal += $orderItemModel->subtotal;
                }
                Options::setOption("Users", $user_dyn_id, 'donate_count', Yii::$app->request->post("donate_count") );

                $orderModel->subtotal =$subtotal;
                $orderModel->discount = 0;

                if(Yii::$app->request->post("discount_code") and $session->get('family_cart')['discount']){

                    $discount_code = Yii::$app->request->post("discount_code");
                    if($discount_model = Discount::find()->where("code = '".$discount_code."'")->one() and  $discount_model->limit > $discount_model->usage){
                        $orderModel->discount = $session->get('family_cart')['discount'];
                        $orderModel->discount_code = $discount_code;
                    }
                }

                $orderModel->final_price = $orderModel->subtotal - $orderModel->discount;
                $orderModel->save();


                if( Yii::$app->request->post("agreement1") ){
                    Options::setOption("Users", $user_dyn_id, 'parent_agreement', "agree" );
                }

                if( Yii::$app->request->post("agreement_1_name") ){
                    Options::setOption("Users", $user_dyn_id, 'parnet_agreement_name', Yii::$app->request->post("agreement_1_name") );
                }

                if( Yii::$app->request->post("next_year_interested") ){
                    $userinfomodel->addTag('2017Interested');
                }

                $success = 1;

            }

        }

        if( $success == 1 ){

            if($orderModel->discount and $orderModel->subtotal > 0 and $orderModel->final_price <=0){
                if($orderModel->discount_code and $discount_code = Discount::find()->where("code='". $orderModel->discount_code . "'" )->one()){
                    $discount_code->usage += 1;
                    $discount_code->save();
                }

                $usersfamiliesmodel->status = 1;
                $usersfamiliesmodel->save( false );

                $orderModel->status = 1;
                $orderModel->save(false);

                if( !$usermodel->status){
                    $usermodel->status = 1;
                    $usermodel->save( false );
                }

                Email::sendByTemplate( Email::FAMILY_REGISTRATON, $userinfomodel->first_name.' '.$userinfomodel->last_name, $usermodel->email, [] );
                Users::loginAs( $usermodel->id );

                return $this->redirect("/user/familyconfirmation");
            }
            return $this->redirect("/user/familypayment/".$orderModel->id.'?type=d');

        } else {


            $parent_agreement = False;
            $donate_count = 0;
            if($id){
                $parent_agreement = Options::find()->where("model='Users' and model_id=".$user_dyn_id." and `key`='parent_agreement'")->one()?true:false;
                $donate_count = Options::find()->where("model='Users' and model_id=".$user_dyn_id." and `key`='donate_count'")->one();
                if($donate_count){
                    $donate_count = $donate_count->value;
                } else {
                    $donate_count = 0;
                }
            }



            Yii::$app->session->set('family_cart', array('children'=>array(), 'donation_count'=>$donate_count, 'not_beginner_count' => $notBeginnerCount));
            return $this->render("family_direct_registration", [
                "usermodel" => $usermodel,
                "userinfomodel" => $userinfomodel,
                "model" => $usersfamiliesmodel,
                "contestantmodel" => $contestantmodel,
                "success" => $success,
                'hear_about' => $hear_about_arr,
                'parent_agreement' => $parent_agreement,
                "donate_count" => $donate_count,
            ]);

        }

    }

    public function actionAddchildren()
    {
        $id = \common\models\Users::user_id();

        $success = 0;

        $session = Yii::$app->session;
        $user_dyn_id = Users::getUserID($id);

        $usermodel = Users::find()->where("id=" . $id)->one();
        $userinfomodel = UserInfo::find()->where("user_id=" . $id)->one();
        $contestantmodel = new \common\models\Contestants();
        $usersfamiliesmodel = UsersFamilies::find()->where("user_id=" . $user_dyn_id)->one();
        $children  = Contestants::find()->joinWith('order')->where('contestants.user_id='.$usersfamiliesmodel->id. " and order.status=0")->all();

        $notBeginnerCount =  OrderItem::getOrderedNotBgChildrenCount($usersfamiliesmodel->id);


        if (Yii::$app->request->post()) {

            if ($oldOrder = Order::find()->where("dyn_user_id =" . $user_dyn_id. " and status=0")->one() ){
                //delete all connected children
                Contestants::deleteAll("order_id=".$oldOrder->id);
                $oldOrder->delete();
            }

            $orderModel = New Order();
            $orderModel->user_id = $usersfamiliesmodel->id;
            $orderModel->dyn_user_id = $user_dyn_id;
            $orderModel->first_name = $userinfomodel->first_name;
            $orderModel->last_name = $userinfomodel->last_name;
            $orderModel->discount = 0;
            $orderModel->subtotal = 0;
            $orderModel->final_price = 0;
            $orderModel->status = 0;
            $orderModel->save();

            $subtotal = 0;

            if (Yii::$app->request->post('Contestants')) {
                foreach (Yii::$app->request->post('Contestants') as $Contestant) {
                    $ContestantModel = new \common\models\Contestants();
                    $ContestantModel->setAttributes($Contestant);
                    $ContestantModel->user_id = $usersfamiliesmodel->id;
                    $ContestantModel->order_id = $orderModel->id;
                    if ($ContestantModel->save()) {
                        if ($ContestantModel->age_group != 'Beginner') {
                            $notBeginnerCount++;
                        }
                        $orderItemModel = new OrderItem();
                        $orderItemModel->order_id = $orderModel->id;
                        $orderItemModel->title = $ContestantModel->first_name;
                        $orderItemModel->description = $ContestantModel->age_group;
                        $orderItemModel->price = ($notBeginnerCount > 4 || $ContestantModel->age_group == 'Beginner') ? 5 : 25;
                        $orderItemModel->quantity = 1;
                        $orderItemModel->subtotal = $orderItemModel->price * $orderItemModel->quantity;
                        $orderItemModel->save();
                        $subtotal += $orderItemModel->subtotal;

                    }
                }
            }
            $for_children_subtotal = $subtotal;
            if (Yii::$app->request->post("donate_agree") and Yii::$app->request->post("donate_count")) {

                $orderItemModel = new OrderItem();
                $orderItemModel->order_id = $orderModel->id;
                $orderItemModel->title = "Sponsoring";
                $orderItemModel->price = 25;
                $orderItemModel->quantity = Yii::$app->request->post("donate_count");
                $orderItemModel->subtotal = $orderItemModel->price * $orderItemModel->quantity;
                $orderItemModel->save();
                $subtotal += $orderItemModel->subtotal;

                $old_donate_count = 0;
                $old_donate = Options::find()->where("`model`='Users' and `model_id`='" . $user_dyn_id . "' and `key`='donate_count'")->one();
                if ($old_donate) {
                    $old_donate_count = $old_donate->value;
                }

                $current_donate_count = Yii::$app->request->post("donate_count");
                Options::setOption("Users", $user_dyn_id, 'donate_count', intval($old_donate_count) + intval($current_donate_count));
                Options::setOption("Users", $user_dyn_id, 'donate_agreement', "1");
            }

            $orderModel->subtotal = $subtotal;
            $orderModel->discount = 0;

            if(Yii::$app->request->post("discount_code") and $session->get('family_cart')['discount']){
                $discount_code = Yii::$app->request->post("discount_code");
                if($discount_model = Discount::find()->where("code = '".$discount_code."'")->one() and $discount_model->limit > $discount_model->usage){
                    $orderModel->discount = $session->get('family_cart')['discount'];
                    $orderModel->discount_code = $discount_code;

                }
            }

            $orderModel->final_price = $orderModel->subtotal - $orderModel->discount;
            $orderModel->save();


            $success = 1;
        }

        if ($success == 1) {

            return $this->redirect("/user/familypayment/" . $orderModel->id."?type=c");

        } else {

            $parent_agreement = Options::find()->where("model='Users' and model_id=".$user_dyn_id." and `key`='parent_agreement'")->one()?true:false;

            Yii::$app->session->set('family_cart', array('children'=>array(), 'donation_count'=>0, 'not_beginner_count' => $notBeginnerCount));
            return $this->render("add_children", [
                "usermodel" => $usermodel,
                "userinfomodel" => $userinfomodel,
                "model" => $usersfamiliesmodel,
                "contestantmodel" => $contestantmodel,
                "success" => $success,
                "children" =>$children,
                'parent_agreement' => $parent_agreement
            ]);

        }

    }

    public function actionFamilyconfirmation(){
        $dashboard_url = Yii::$app->urlManager->createUrl('/user/dashboard');
        $google_community_url = Yii::$app->params["google_community_url"];
        $instruction_url = Yii::$app->params["instruction_url"];
        return $this->render("family_confirmation",
            array('dashboard_url' => $dashboard_url, 'google_community_url' => $google_community_url, 'instruction_url' => $instruction_url));
    }

    public function actionDonationconfirmation(){
        return $this->render("donation_confirmation");
    }

    public function actionFamilypayment( $id ){

        if( !$order = Order::find()->where("id=".$id." AND status=0")->one() )
            return $this->redirect("/404");

        $order_items = OrderItem::find()->where("order_id=".$order->id)->all();

        $user_id = \common\models\Users::getUserRealID( $order->dyn_user_id );

        $usermodel = Users::find()->where("`id`=".$user_id)->one();
        $infomodel = UserInfo::find()->where("`user_id`=".$user_id)->one();

        $model = new FamilyPayment();

        $model->order_id = $id;

        $model->first_name = $infomodel->first_name;
        $model->last_name = $infomodel->last_name;
        $model->email = $usermodel->email;
        $model->address_1 = $infomodel->address_1;
        $model->address_2 = $infomodel->address_2;
        $model->city = $infomodel->city;
        $model->state = $infomodel->state;
        $model->zip = $infomodel->zip;

        if( $model->load(Yii::$app->request->post()) && $model->validate() ){

            if( $model->pay() ){

                $emailparams = [
                    "family_contact_info" => $model->first_name." ".$model->last_name."<br /> ".$model->address_1."<br /> ".$model->city.", ".$model->state."<br /> ".$model->zip,
                    "payment_cart" => $this->renderPartial("//elements/family_receipt_cart", ["order" => $order, "order_items" => $order_items]),
                ];

                Email::sendByTemplate( Email::FAMILY_PAYMENT, $model->first_name.' '.$model->last_name, $model->email, $emailparams );
                Email::sendByTemplate( Email::FAMILY_REGISTRATON, $model->first_name.' '.$model->last_name, $model->email, [] );

                if( !$usermodel->status){

                    $usermodel->status = 1;
                    $usermodel->save( false );

                }

                Users::loginAs( $user_id );

                return $this->redirect("/user/familyconfirmation");

            }

        }

        $tokenmodel = UsersTokens::find()->where("user_id=".$user_id)->one();
        $from = Yii::$app->request->get("type");

        return $this->render("family_payment", [
            "model" => $model,
            "order" => $order,
            "order_items" => $order_items,
            "usermodel" => $usermodel,
            "tokenmodel" => $tokenmodel,
            'from' => $from
        ]);

    }

    public function actionDonationpayment(){


        $user_id = Users::user_id();

        $model = new FamilyPayment();

        if($user_id){
            $dyn_id = Users::getUserID($user_id);

            $usermodel = Users::find()->where("`id`=".$user_id)->one();
            $infomodel = UserInfo::find()->where("`user_id`=".$user_id)->one();

            $model->first_name = $infomodel->first_name;
            $model->last_name = $infomodel->last_name;
            $model->email = $usermodel->email;
            $model->address_1 = $infomodel->address_1;
            $model->address_2 = $infomodel->address_2;
            $model->city = $infomodel->city;
            $model->state = $infomodel->state;
            $model->zip = $infomodel->zip;
            $model->dyn_id = $dyn_id;
        }



        if(Yii::$app->request->isPost) {
            $donation_amount = Yii::$app->request->post('donation_amount');
            $model->scenario = 'subscription';

            if(Yii::$app->request->post('donation_monthly')){

                $model->donation_type = "m";

                if ($model->load(Yii::$app->request->post()) && $model->validate()) {

                    if ($subscription = $model->subscribe()) {

                        Email::sendByTemplate( Email::DONATION_PAYMENT_SUBSCRIPTION, $model->first_name.' '.$model->last_name, $model->email, ['donation'=>$subscription->amount]);

                        return $this->redirect("/user/donationconfirmation");
                    }
                }


            } else {
                $model->donation_type = "o";

                if ($model->load(Yii::$app->request->post()) && $model->validate()) {

                    $order = new Order();
                    $order->first_name = $model->first_name;
                    $order->last_name = $model->last_name;

                    $order->dyn_user_id = $model->dyn_id;
                    $order->discount = 0;
                    $order->subtotal = $model->amount;
                    $order->final_price = $model->amount;
                    $order->status = 0;
                    $order->save(false);

                    $model->order_id = $order->id;

                    $orderItem = new OrderItem();
                    $orderItem->order_id = $order->id;
                    $orderItem->title = 'Donation';
                    $orderItem->price = $model->amount;
                    $orderItem->quantity = 1;
                    $orderItem->subtotal = $model->amount;
                    $orderItem->save();


                    if ($model->pay()) {
                        if($model->dyn_id){
                            Email::sendByTemplate( Email::DONATION_PAYMENT, $model->first_name.' '.$model->last_name, $model->email, ['donation'=>$order->final_price]);
                            return $this->redirect("/user/donationconfirmation");
                        } else {
                            Email::sendByTemplate( Email::PUBLIC_DONATION_PAYMENT, $model->first_name.' '.$model->last_name, $model->email, ['donation'=>$order->final_price]);
                            return $this->redirect("/user/donationconfirmation");
                        }

                    }

                }
            }
        }

        return $this->render("donation_payment", [
            "model" => $model
        ]);

    }

    public function actionLoadchildbyajax($index)
    {

        $model = new Contestants();
        return $this->renderPartial('family/_child', array(
            'model' => $model,
            'index' => $index,
            'include_js' => true
        ));
    }

    public function actionUpdatecartbyajax()
    {
        $cart = Yii::$app->session->get('family_cart');
        $action = Yii::$app->request->get("action");

        if($action == 'remove'){
            $index = Yii::$app->request->get("index");
            unset($cart['children'][$index]);
        } else if($action == 'donation'){
            $count = Yii::$app->request->get("param");
            $cart['donation_count'] = $count;
        } else if($action == "date_of_birth"){
            $index = Yii::$app->request->get("index");
            $date_of_birth = Yii::$app->request->get("param");
            $age = Contestants::getAge($date_of_birth);
            $cart['children'][$index]['age_group'] = Contestants::get_age_group($age);
        } else if($action == "change_name"){
            $index = Yii::$app->request->get("index");
            $name = Yii::$app->request->get("param");
            $cart['children'][$index]['name'] =$name;
        }  else if($action == "discount"){
            $discount_code = Yii::$app->request->get("param");
            $cart['discount_code'] = $discount_code;
            $cart['discount_type'] = '';
            $cart['discount_per_type'] = '';
            $cart['discount_amount'] = 0;
            $cart['discount_error'] = '';
            if($discount_code) {
                if ($discount_model = Discount::find()->where("code = '" . $discount_code . "'")->one() and  $discount_model->limit > $discount_model->usage) {
                    $cart['discount_code'] = $discount_code;
                    $cart['discount_type'] = $discount_model->discount_type;
                    $cart['discount_per_type'] = $discount_model->per_type;
                    $cart['discount_amount'] = $discount_model->amount;

                } else {
                    $cart['discount_error'] = 'Invalid coupon code.';
                }
            }
        }

        $has_discount = boolval(@$cart['discount_amount'] > 0);
        $discount = 0;
        $notBeginnerCount = @$cart['not_beginner_count'];
        $total = 0;


        if (isset($cart['children']) and count($cart['children']) > 0) {
            foreach ($cart['children'] as $index => $child) {
                if (!isset($child['age_group']) || $child['age_group'] != "Beginner") {
                    $notBeginnerCount++;
                }

                $cart['children'][$index]['price'] = $itemPrice = ($notBeginnerCount > 4 || $child['age_group'] == "Beginner") ? 5 : 25;
                $total += $itemPrice;

                if($has_discount and $cart['discount_per_type'] == 1 and $notBeginnerCount <= 4 and $child['age_group'] != "Beginner"){
                    if($cart['discount_type']  == 'fixed'){
                        $discount += $cart['discount_amount'];
                    } else {
                        $discount += $itemPrice * $cart['discount_amount'] / 100;
                    }

                }

            }
        }

         if($has_discount and $cart['discount_per_type'] == 0) {
             if ($cart['discount_type'] == 'fixed') {
                 $discount += $cart['discount_amount'];
             } else {
                 $discount += $total * $cart['discount_amount'] / 100;
             }
         }

        if ($has_discount and $discount > $total) {
            $cart['discount_amount'] = 0;
            $discount = 0;
            $cart['discount_error'] = "Discount greater then the total.";
        }

        if($has_discount and $discount == 0){
            $cart['discount_error'] = "Discount can not be applied.";
        }

        $cart['donation'] = isset($cart['donation_count'])?$cart['donation_count'] * 25:0;
        $cart['discount'] = round($discount, 0, PHP_ROUND_HALF_DOWN);
        $cart['total'] = $total - $cart['discount'];
        $cart['total'] +=  $cart['donation'];


        Yii::$app->session->set('family_cart', $cart);

        return $this->renderPartial('family/_cart');
    }

    public function actionConnecttohost($id){

        Users::joinHost( $id );

        return $this->redirect("/user/dashboard-family-host");

    }

    public function actionDisconnectfromhost(){

        Users::disconnectHost(  );

        return $this->redirect("/user/dashboard-family-host");

    }

    public function actionDashboard(){

        $user_id = \common\models\Users::user_id();
        $user_dyn_id = \common\models\Users::getUserID( $user_id );

        $usermodel = Users::find()->where("`id`=".$user_id)->one();
        $infomodel = UserInfo::find()->where("`user_id`=".$user_id)->one();

        $infomodel->scenario = 'family_direct';

        if( !$hostmodel = UsersHosts::find()->where("`user_id`=".$user_dyn_id)->one() )
            $hostmodel = new UsersHosts();

        $hostmodel->user_id = $user_dyn_id;

        if( !$bgcheckmodel = UserCheck::find()->where("`user_id`=".$user_dyn_id)->one() )
            $bgcheckmodel = new UserCheck();

        $bgcheckmodel->user_id = $user_dyn_id;

        if( $family = UsersFamilies::find()->where("user_id=".$user_dyn_id." AND status=1")->one() ){

            $children = Contestants::find()->where("user_id=".$family->id." and status=1")->indexBy("id")->all();

        }

        if( !$hostmodel->isNewRecord ){

            $hostJoinedFamilies = UsersFamilies::find()->where("users_families.`id` IN ( SELECT `family_host`.`family_id` FROM `family_host` WHERE `family_host`.host_id=".$hostmodel->id.")")->all();

        } else
            $hostJoinedFamilies = false;

        if( Yii::$app->request->post("save_user_check") ){

            $infomodel->scenario = UserInfo::SCENARIO_BGCHECK;

            $return = [];

            if( Yii::$app->request->post("check_age") ) {

                $infomodel->load(Yii::$app->request->post());
                $s_infomodel = $infomodel->save();

                $bgcheckmodel->load(Yii::$app->request->post());
                $bgcheckmodel->middle_name = $infomodel->middle_name;
                $bgcheckmodel->date_of_birth = $infomodel->date_of_birth;
                $bgcheckmodel->address_1 = $infomodel->address_1;
                $bgcheckmodel->city = $infomodel->city;
                $bgcheckmodel->state = $infomodel->state;
                $bgcheckmodel->country = $infomodel->country;
                $bgcheckmodel->zip = $infomodel->zip;
                $bgcheckmodel->email = $usermodel->email;
                $bgcheckmodel->ssn = $infomodel->ssn;
                $bgcheckmodel->status = 'incoming';
                $s_bgcheckmodel = $bgcheckmodel->save();

                if ($s_infomodel and $s_bgcheckmodel) {

                    $return["response"] = "ok";

                } else {

                    $bgcheck_errors = $bgcheckmodel->getErrors();
                    if (isset($bgcheck_errors['first_name'])){
                        $bgcheck_errors['legal_first_name'] = $bgcheck_errors['first_name'];
                        unset($bgcheck_errors['first_name']);
                    }
                    if (isset($bgcheck_errors['last_name'])){
                        $bgcheck_errors['legal_last_name'] = $bgcheck_errors['last_name'];
                        unset($bgcheck_errors['last_name']);
                    }

                    $return["response"] = "error";
                    $return["errors"] = array_merge($infomodel->getErrors(), $bgcheck_errors);

                }

            } else {

                $return["response"] = "error";
                $return["errors"] = ["date_of_birth" => ["Please confirm your age."]];

            }

            echo json_encode( $return );
            exit;

        }

        if( Yii::$app->request->post("save_contact_info") ){

            $infomodel->scenario = UserInfo::SCENARIO_INFO;

            $return = [];

            if( $infomodel->load( Yii::$app->request->post() ) && $infomodel->save() ){

                $return["response"] = "ok";

            } else {

                $return["response"] = "error";
                $return["errors"] = $infomodel->getErrors();

            }

            echo json_encode( $return );
            exit;

        }

        if( Yii::$app->request->post("save_contestant_info") && Yii::$app->request->post("contestant_id") ){

            $return = [];

            if( $user_id = Users::getUserID( Users::user_id() ) ) {

                if ($contestant = Contestants::find()->where("id=" . (int)Yii::$app->request->post("contestant_id") . " AND `user_id` IN (SELECT `id` FROM `users_families` WHERE `user_id`=" . $user_id . ")")->one()) {

                    if ($contestant->load(Yii::$app->request->post()) && $contestant->save()) {

                        $return["response"] = "ok";
                        $return["contestant_id"] = (int)Yii::$app->request->post("contestant_id");
                        $return["name"] = $contestant->first_name.' '.$contestant->last_name;
                        $return["dob"] = \common\components\Format::date( $contestant->date_of_birth, 'Y-m-d', 'm/d/Y' ).' '.( $contestant->age_group != '' ? '('.$contestant->age_group.')' : '' );
                        $return["gender"] = substr(Yii::$app->params["gender"][ $contestant->gender ], 0, 1);
                        $return["version"] = Yii::$app->params["versions"][ $contestant->version ];
                        $return["flashmessage"] = Yii::$app->session->getFlash('success');

                    } else {

                        $return["response"] = "error";
                        $return["errors"] = $contestant->getErrors();

                    }

                }

            }

            echo json_encode( $return );
            exit;

        }

        if( Yii::$app->request->post("save_host_info") ){

            $return = [];

            if( $hostmodel->load( Yii::$app->request->post() ) && $hostmodel->save() ){

                $return["response"] = "ok";

            } else {

                $return["response"] = "error";
                $return["errors"] = $hostmodel->getErrors();

            }

            echo json_encode( $return );
            exit;

        }

        if( Yii::$app->request->post("save_family") ){

            $return = [];

            if( \yii\base\Model::loadMultiple($children, Yii::$app->request->post()) ){

                foreach ($children as $index=>$child) {

                    if( $child->validate() ){

                        $child->save();

                    } else {

                        if( !isset( $return["multierrors"] ) )   $return["multierrors"] = [];

                        $return["multierrors"][$index] = $child->getErrors();

                        $return["response"] = "error";

                    }

                }

                if( !isset( $return["multierrors"] ) )  $return["response"] = "ok";

            }

            echo json_encode( $return );
            exit;

        }



        $this->view->params['bodyClass'] = 'account-dashboard';
        $this->view->params['bodyClassDefault'] = false;

        return $this->render("dashboard", [
            "usermodel" => $usermodel,
            "infomodel" => $infomodel,
            "hostmodel" => $hostmodel,
            "bgcheckmodel" => $bgcheckmodel,
            "family" => $family,
            "children" => isset($children) ? $children : false,
            "hostJoinedFamilies" => $hostJoinedFamilies,
        ]);

    }

    public function actionDashboardFamilyHost(){

        $user_id = \common\models\Users::user_id();
        $user_dyn_id = \common\models\Users::getUserID( $user_id );

        $usermodel = Users::find()->where("`id`=".$user_id)->one();
        $infomodel = UserInfo::find()->where("`user_id`=".$user_id)->one();

        if( !$hostmodel = UsersHosts::find()->where("`user_id`=".$user_dyn_id)->one() )
            $hostmodel = new UsersHosts();

        $hostmodel->user_id = $user_dyn_id;

        if( !$bgcheckmodel = UserCheck::find()->where("`user_id`=".$user_dyn_id)->one() )
            $bgcheckmodel = new UserCheck();

        $bgcheckmodel->user_id = $user_dyn_id;

        if( $family = UsersFamilies::find()->where("user_id=".$user_dyn_id." AND status=1")->one() ){

            $children = Contestants::find()->where("user_id=".$family->id." and status=1")->indexBy("id")->all();

        }


        $this->view->params['bodyClass'] = 'account-dashboard';
        $this->view->params['bodyClassDefault'] = false;

        return $this->render("dashboard_familyhost", [
            "usermodel" => $usermodel,
            "infomodel" => $infomodel,
            "hostmodel" => $hostmodel,
            "bgcheckmodel" => $bgcheckmodel,
            "family" => $family,
            "children" => isset($children) ? $children : false,
        ]);

    }

    public function actionDashboardResources(){

        $user_id = \common\models\Users::user_id();
        $user_dyn_id = \common\models\Users::getUserID( $user_id );

        $usermodel = Users::find()->where("`id`=".$user_id)->one();
        $infomodel = UserInfo::find()->where("`user_id`=".$user_id)->one();

        if( !$hostmodel = UsersHosts::find()->where("`user_id`=".$user_dyn_id)->one() )
            $hostmodel = new UsersHosts();

        $hostmodel->user_id = $user_dyn_id;

        if( !$bgcheckmodel = UserCheck::find()->where("`user_id`=".$user_dyn_id)->one() )
            $bgcheckmodel = new UserCheck();

        $bgcheckmodel->user_id = $user_dyn_id;

        if( $family = UsersFamilies::find()->where("user_id=".$user_dyn_id." AND status=1")->one() ){

            $children = Contestants::find()->where("user_id=".$family->id." and status=1")->indexBy("id")->all();

        }


        $this->view->params['bodyClass'] = 'account-dashboard';
        $this->view->params['bodyClassDefault'] = false;

        return $this->render("dashboard_studymaterials", [
            "usermodel" => $usermodel,
            "infomodel" => $infomodel,
            "hostmodel" => $hostmodel,
            "bgcheckmodel" => $bgcheckmodel,
            "family" => $family,
            "children" => isset($children) ? $children : false,
        ]);

    }

    public function actionDashboardResourcesFamily(){

        $user_id = \common\models\Users::user_id();
        $user_dyn_id = \common\models\Users::getUserID( $user_id );

        $usermodel = Users::find()->where("`id`=".$user_id)->one();
        $infomodel = UserInfo::find()->where("`user_id`=".$user_id)->one();

        if( !$hostmodel = UsersHosts::find()->where("`user_id`=".$user_dyn_id)->one() )
            $hostmodel = new UsersHosts();

        $hostmodel->user_id = $user_dyn_id;

        if( !$bgcheckmodel = UserCheck::find()->where("`user_id`=".$user_dyn_id)->one() )
            $bgcheckmodel = new UserCheck();

        $bgcheckmodel->user_id = $user_dyn_id;

        if( $family = UsersFamilies::find()->where("user_id=".$user_dyn_id." AND status=1")->one() ){

            $children = Contestants::find()->where("user_id=".$family->id." and status=1")->indexBy("id")->all();

        }


        $this->view->params['bodyClass'] = 'account-dashboard';
        $this->view->params['bodyClassDefault'] = false;

        return $this->render("dashboard_resources_family", [
            "usermodel" => $usermodel,
            "infomodel" => $infomodel,
            "hostmodel" => $hostmodel,
            "bgcheckmodel" => $bgcheckmodel,
            "family" => $family,
            "children" => isset($children) ? $children : false,
        ]);

    }

    public function actionChangeavatar(){

        $user_id = \common\models\Users::user_id();

        $infomodel = UserInfo::find()->where("`user_id`=".$user_id)->one();

        if( $avatar = UploadedFile::getInstance($infomodel, 'avatar') ){

            $ext = pathinfo($avatar->name, PATHINFO_EXTENSION);
            if( $avatar->size <= 5242880 && in_array( $avatar->type, ["image/jpeg", "image/gif", "image/png"] )  && in_array($ext, ['jpeg', 'jpg', 'png', 'gif'])) {

                $infomodel->avatar = $avatar;
                if ($infomodel->upload() && $infomodel->save()) {

                    echo $infomodel->avatar ? attachments::getThumbnailUrl('/upload/avatar/' . $infomodel->user_id . '/' . $infomodel->avatar, 100, 95, 'CROP') : '/images/avatar.jpg';

                }

            }

        }

        exit;

    }

    public function actionGethostsmap(){

        if( Yii::$app->request->post("lat") && Yii::$app->request->post("lng") ){

            $mylat = Yii::$app->request->post("lat");
            $mylng = Yii::$app->request->post("lng");

            if( $user_id = \common\models\Users::user_id() ) {
                $user_dyn_id = \common\models\Users::getUserID($user_id);

                if (!$hostmodel = UsersHosts::find()->where("`user_id`=" . $user_dyn_id)->one())
                    $hostmodel = new UsersHosts();

            }

            $season = \common\models\Seasons::getCurrent();

            $hosts = \common\models\UsersHosts::find()->where("`status`=1 AND `user_id` IN (SELECT `dynamic_id` FROM `users_id` WHERE `season_id`=".$season->id.") AND `latitude`!='' AND `longitude`!=''")->all();

            $data = [

            ];

            foreach( $hosts as $host ){

                $user_info = \common\models\UserInfo::find()->where("user_id=". $host->user->user_id)->one();

                $user = \common\models\Users::find()->where("id=". $host->user->user_id)->one();

                $hostcount = $host->hostcount;

                if( $hostcount["count"] != -1 && $hostcount["count"] <= $hostcount["used"] ){
                    $mapicon = 'full';
                    $canjoin = 0;
                } else {
                    $mapicon = 'local';
                    $canjoin = 1;
                }

                if( $hostcount["count"] == -1 ){
                    $spottext = '<br>Unlimited spots';
                } else {
                    if( $hostcount["count"] > $hostcount["used"] ){
                        $spottext = '<br>'.( $hostcount["count"] - $hostcount["used"] ).' spots remaining';
                    } else {
                        $spottext = '';
                    }
                }

                $dist = $this->distance( $mylat, $mylng, $host->latitude, $host->longitude );

                $citystate = '<br>';
                if( $host->summer_event_city == '' || $host->summer_event_state == '' ){
                    $citystate .= $user_info->city.', '.$user_info->state;
                } else {
                    $citystate .= $host->summer_event_city.', '.$host->summer_event_state;
                }

                $data[] = [
                    "lat" => $host->latitude,
                    "lng" => $host->longitude,
                    "html" => '<b>'.$user_info->first_name.' '.$user_info->last_name.'</b><br>'.$host->summer_event_address.$citystate.$spottext.( $canjoin ? '<br><br><a href="#" class="btn btn-success join_host_to_family" data-host-id="'.$host->id.'">JOIN NOW</a>' : '' ),
                    "icon" => "/widgets/map/icons/".$mapicon.".png",
                    "location" => $host->summer_event_address.$citystate,
                    "location_name" => $host->summer_event_location,
                    "host" => $user_info->first_name.' '.$user_info->last_name,
                    "email" => $user->email,
                    "host_id" => $host->id,
                    "canjoin" => $canjoin,
                    "distance" => $dist,
                    "join_enable" => true,
                ];

            }

            usort($data, function ($a, $b) {
                return $a['distance'] - $b['distance'];
            });

            $data = array_slice( $data, 0, 25 );

            echo json_encode( $data );

        }

    }

    public function actionConnecthostaftereg(){

        if( Yii::$app->request->get("host_id") ){

            $session = Yii::$app->session;

            $session['connect_to_host'] = (int)Yii::$app->request->get("host_id");



        }

        return $this->redirect("/user/login");

        exit;

    }

    public function actionChangehoststatus(){

        if( $current_user_id = Users::user_id() ) {

            $user_dyn_id = Users::getUserID($current_user_id);

            if ($host = UsersHosts::find()->where("user_id=" . $user_dyn_id)->one()) {

                $host->status = Yii::$app->request->post("status");

                $host->save( false );

            }

        }

        exit;

    }

    private function distance($lat1, $lng1, $lat2, $lng2, $u = '1')
    {
        $u = strtolower($u);

        if ($u == 'k') {
            $u = 1.609344;
        } // kilometers
        elseif ($u == 'n') {
            $u = 0.8684;
        } // nautical miles
        elseif ($u == 'm') {
            $u = 1;
        } // statute miles (default)

        $d = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($lng1 - $lng2));
        $d = rad2deg(acos($d));
        $d = $d * 60 * 1.1515;

        $d = ($d * $u); // apply unit
        $d = round($d); // optional
        return $d;
    }

}
