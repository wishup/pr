<?php
namespace frontend\controllers\widgets;

use frontend\models\ContactForm;
use Yii;
use common\components\Email;

class ContactController{

    public function init( &$params ){

        $model = new ContactForm();

        if( Yii::$app->request->post("send_contact_form") && $model->load(Yii::$app->request->post()) && $model->validate() ){

            $contact = new \common\models\ContactForm();

            $contact->first_name = $model->first_name;
            $contact->last_name = $model->last_name;
            $contact->subject = $model->subject;
            $contact->email = $model->email;
            $contact->message = $model->message;
            $contact->date = date("Y-m-d H:i:s");

            $contact->save();

            $emailparams = [
                "first_name" => $model->first_name,
                "last_name" => $model->last_name,
                "subject" => $model->subject,
                "email" => $model->email,
                "message" => '<p>'.nl2br( $model->message ).'</p>',
            ];

            $bcc = explode(",", Yii::$app->params["settings"]["notification_email_bcc"]);

            if( Email::sendByTemplate(Email::CONTACT_FORM, "", Yii::$app->params["settings"]["notification_email"], $emailparams, $bcc, 'Contact form: '.$model->subject, $model->first_name.' '.$model->last_name, $model->email ) ){

                $params["sentEmail"] = 1;

                $model = new ContactForm();

            }

        }

        $model->captcha = '';

        $params["model"] = $model;

    }

}