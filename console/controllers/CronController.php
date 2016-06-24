<?php
namespace console\controllers;

use common\models\Options;
use common\models\Seasons;
use common\models\UsersFamilies;
use frontend\controllers\UserController;
use Yii;
use yii\console\Controller;
use common\components\trak1API;
use common\models\UserCheck;
use common\models\Users;
use common\components\Email;
use common\models\Emails;
use common\models\Mailing;

class CronController extends Controller {

    public function actionIndex(){

        // Send mailing emails
        Mailing::send();

        return true;

    }

    // Action will be called once in a minute
    public function actionNotifications(){

        // Send notifications every 48 hours about not completed background check
        $this->send_bgcheck_submit_notifications();
        $this->remindToIncompleteUsers();

    }

    public function actionTrak1check(){

        $trak1 = new trak1API();

        $users = UserCheck::find()->where("( `status`='biblebee_approved' OR `status`='bg_check' ) AND `TransactionID`!=''")->all();

        foreach( $users as $user ){

            $lastchangedate = new \DateTime( $user->status_changed_at );
            $lastchanged = $lastchangedate->getTimestamp();

            if( $user->status == 'bg_check' && ( time() - $lastchanged ) >= \Yii::$app->params["trak1check_interval"] ){

                $user->status = 'need_assistance';
                $user->save();

                continue;

            }

            $status = $trak1->check( $user->TransactionID );

            switch( strtolower($status) ){

                case 'approved':
                case 'criminal results accepted':

                    $user->status = 'approved';
                    $user->save();

                    break;

                case 'need_assistance':
                case 'individualized assessment required':

                    $user->status = 'need_assistance';
                    $user->save();

                    break;

                case 'rejected':
                case 'criminal results declined':

                    $user->status = 'rejected';
                    $user->save();

                    break;

            }

        }

        return true;

    }

    public function actionTrak1submit(){

        $trak1 = new trak1API();

        $users = UserCheck::find()->where("`status`='biblebee_approved' and `TransactionID`=''")->all();

        $season = Seasons::find()->where("active=1")->one();

        foreach( $users as $user ){

            $data = $user->getUserInfo( Users::getUserRealID($user->user_id), $season->id );

            $result = $trak1->submit( $data );

            if( isset($result["TransactionID"]) ) {

                $user->TransactionID = $result["TransactionID"];

                $user->status = 'bg_check';

            }

            if( isset($result["errors"]) ) {

                $user->status = 'need_assistance';

            }

            $user->save(false);

        }

        return true;

    }

    public function actionSendemails(){

        $email_one_time_limit = 3;

        $sent_emails = 0;

        $emails = Emails::find()->where("status='outbox' and send_date='".date("Y-m-d")."'")->orderBy("priority desc")->limit($email_one_time_limit)->all();

        foreach( $emails as $email ){

            if( $sent_emails >= $email_one_time_limit ) break;

            Email::send( $email->from_name, $email->from_email, $email->to_name, $email->to_email, $email->subject, $email->content, unserialize($email->attachments) );

            $sent_emails ++;

        }

        $emails = Emails::find()->where("status='outbox' and (send_date='' or send_date is null)")->orderBy("priority desc")->limit($email_one_time_limit)->all();

        foreach( $emails as $email ){

            if( $sent_emails >= $email_one_time_limit ) break;

            if( Email::send( $email->from_name, $email->from_email, $email->to_name, $email->to_email, $email->subject, $email->content, unserialize($email->attachments) ) ) {

                $email->status = 'sent';
                $email->sent_at = date("Y-m-d H:i:s");

                $email->save();

                $sent_emails ++;

            }

        }

    }

    private function send_bgcheck_submit_notifications(){

        $users = Users::find()->where("`status`=1 AND `id` IN (SELECT `users_id`.`user_id` FROM `users_id` WHERE `users_id`.`season_id`=(SELECT `seasons`.`id` FROM `seasons` WHERE `seasons`.`active`=1) AND ( `users_id`.`dynamic_id` IN (SELECT `user_check`.`user_id` FROM `user_check` WHERE `user_check`.`status`='') OR `users_id`.`dynamic_id` NOT IN (SELECT `user_check`.`user_id` FROM `user_check`) ) AND `users_id`.`dynamic_id` IN (SELECT `users_hosts`.`user_id` FROM `users_hosts` WHERE `users_hosts`.`status` IN (1,2)) )")->all();

        foreach( $users as $user ){

            $sent_time = Options::getOption("Users", $user->id, "bgcheck_submit_notify_time");

            if( !$sent_time || ( time() - $sent_time ) >= 259200 ){

                if( Email::sendByTemplate( "bgcheck_submit", $user->userInfos->first_name, $user->email, ["first_name" => $user->userInfos->first_name] ) ){

                    Options::setOption("Users", $user->id, "bgcheck_submit_notify_time", time());

                }

            }

        }

    }

    private function remindToIncompleteUsers(){
        $option_slug = Options::INCOMPLETE_USER_REMINDER;
        $current_season  = Seasons::find()->where("active=1")->one();
        $incompleteUsers = UsersFamilies::find()
            ->joinWith(array('user' => function ($q) {
                $q->joinWith(array('user' => function ($q) {
                    $q->joinWith('userInfos');
                }));
            }))
            ->leftJoin(Options::tableName(), "options.model='Users' AND options.model_id =users.id AND options.key = :incomplete", array(':incomplete' => $option_slug))
            ->where("users_families.status != 1 AND options.id IS NULL AND users_families.created_at < :created_date and users_id.season_id = :current_season", array(':created_date' => date("Y-m-d H:i:s", strtotime('-24 hours')), ':current_season' => $current_season->id))
            ->limit(2)->all();


        foreach ($incompleteUsers as $family) {
            $userModel = $family->user->user;
            $sent = Email::sendByTemplate(Email::INCOMPLETE_USERS, $userModel->userInfos->first_name . ' ' . $userModel->userInfos->last_name, $userModel->email, array('user_first_name' => $userModel->userInfos->first_name, 'completion_url' => 'http://biblebee.org/user/familydirectregistration' . '?id=' . $userModel->id));

            if ($sent) {
                Options::setOption('Users', $userModel->id, $option_slug, 1);
            }
        }
    }

}