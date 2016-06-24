<?php
namespace frontend\controllers\widgets;

use common\components\Email;
use common\models\Subscribers;
use Yii;
use frontend\models\StudyguideSubscribe;

class GetstartedController{

    public function init( &$params ){

        $model = new StudyguideSubscribe();

        if( Yii::$app->request->post("send_contact_form") && $model->load(Yii::$app->request->post()) && $model->validate() ){

            $emailparams = [
                "first_name" => $model->first_name,
                "last_name" => $model->last_name,
                "subject" => $model->subject,
                "email" => $model->email,
                "message" => $model->message,
            ];

            if( Email::sendByTemplate( Email::CONTACT_FORM, "", $params["email_to"], $emailparams ) ){

                $params["sentEmail"] = 1;

            }

        }

        $params["model"] = $model;


    }

}