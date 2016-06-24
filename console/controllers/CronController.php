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

}