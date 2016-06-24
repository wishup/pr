<?php
namespace common\components;

use backend\controllers\EmailtemplatesController;
use common\models\EmailGroups;
use common\models\Emails;
use common\models\Emailtemplates;
use common\models\Emaillayouts;
use common\models\Unsubscribe;
use Yii;

class Email{

    const FAMILY_REGISTRATON = 'family_registration';
    const HOST_REGISTRATON = 'host_registration';
    const FAMILY_PAYMENT = 'family_payment';
    const PASSWORD_RESTORE = 'password_restore';
    const CONTACT_FORM = 'contact_form';
    const ACCOUNT_CONFIRMATION = 'account_confirmation';
    const DONATION_PAYMENT = 'donation_payment';
    const PUBLIC_DONATION_PAYMENT = 'public_donation_payment';
    const DONATION_PAYMENT_SUBSCRIPTION = 'donation_payment_subscription';
    const INCOMPLETE_USERS = 'incomplete_users';

    public static function add( $from_name, $from_email, $to_name, $to_email, $subject, $content, $attachments = [], $priority = 1, $send_date = '' ){

            $email = new Emails();

            $email->from_name = $from_name;
            $email->from_email = $from_email;
            $email->to_name = $to_name;
            $email->to_email = $to_email;
            $email->subject = $subject;
            $email->content = $content;
            $email->attachments = serialize($attachments);
            $email->priority = $priority;
            $email->status = "outbox";
            if( $send_date!='' ) $email->send_date = $send_date;
            $email->created_at = date("Y-m-d H:i:s");

            $email->hash = $email->getEmailHash();

            $email->save();

    }

    public static function send( $from_name, $from_email, $to_name, $to_email, $subject, $content, $attachments = [], $bcc = [], $reply_to = null ){

        $email = \Yii::$app->mailer->compose()
            ->setFrom([ $from_email => $from_name ])
            ->setTo([ $to_email => $to_name ])
            ->setSubject($subject)
            ->setHtmlBody($content);

        if( $reply_to ){

            $email->setReplyTo($reply_to);

        }

        if (count($bcc) > 0) {
            if (is_array($bcc)) {
                $bcc = array_map('trim', $bcc);
            }
            $email->setBcc($bcc);
        }

        $email->send();

        return true;

    }

    public static function sendByTemplate( $template_slug, $to_name, $to_email, $params = [], $bcc = [], $subject = Null, $from_name = null, $reply_to = null){



        $template = Emailtemplates::find()
            ->where(['slug' => $template_slug])
            ->one();
        if(!$template or $template->status == 0){
            return false;
        }

        if( $template->group_id ) {

            if (Unsubscribe::find()->where("`email`='" . $to_email . "' AND `group_id`=" . $template->group_id)->one()) {
                return false;
            }

        }

        $content = Email::render($template->id, $params, $to_email);
        if(!$subject){
            $subject = $template->subject;
        }

        if( self::send( $from_name ? $from_name : $template->from_name, $template->from_email, $to_name, $to_email, $subject, $content, [], $bcc, $reply_to ) )
            return true;
        else
            return false;

    }

    public static function sendCsStatusChange( $template_id, $to_name, $to_email, $params = [] ){

        $template = Emailtemplates::find()
            ->where(['id' => $template_id])
            ->one();
        if(!$template or $template->status == 0){
            return false;
        }

        if(isset($params['cs_content']) and $params['cs_content']){
            $content = $params['cs_content'];
            unset($params['cs_content']);
            $content = self::renderFromText($content, $template->layout_id, $params);
        } else {
            $content = Email::render($template_id, $params);
        }


        if( self::send( $template->from_name, $template->from_email, $to_name, $to_email, $template->subject, $content ) )
            return true;
        else
            return false;

    }

    public static function render($template_id, $params=array(), $to_email = ''){

        $template = Emailtemplates::find()
            ->where(['id' => $template_id])
            ->one();
        $content = $template->content;

        $layout = Emaillayouts::find()
            ->where(['id' => $template->layout_id])
            ->one();
        $path = $layout->path;

        foreach($params as $key=>$value){
            $content = str_replace('{'.$key.'}',$value,$content);
        }

        if( $template->group_id ) {

            if ($groupmodel = EmailGroups::find()->where("id=" . $template->group_id)->one()) {

                $unsubscribe = Yii::$app->controller->renderFile('@frontend/themes/basic/emails/elements/unsubscribe.php', ["group" => $groupmodel, "to_email" => $to_email]);

            } else {

                $unsubscribe = false;

            }

        } else
            $unsubscribe = false;

        return Yii::$app->controller->renderFile($path,["content" => $content, "unsubscribe" => $unsubscribe]);
    }

    public static function renderFromText($content, $layout_id, $params=array()){


        $layout = Emaillayouts::find()
            ->where(['id' => $layout_id])
            ->one();
        $path = $layout->path;

        foreach($params as $key=>$value){
            $content = str_replace('{'.$key.'}',$value,$content);
        }

        return Yii::$app->controller->renderFile($path,["content" => $content]);
    }

}