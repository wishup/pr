<?php
namespace frontend\controllers\widgets;

use common\models\Users;
use Yii;
use common\models\MessagingUsers;

class AdminmessagesController{

    public function init( &$params ){

        $user_id = Users::user_id();

        if( $user_id && Yii::$app->request->post("close_admin_msg") ){

            if( $msg = MessagingUsers::find()->where("user_id=".$user_id." AND message_id=".(int)Yii::$app->request->post("close_admin_msg"))->one() ){

                if( $msg->message->can_close == 1 ) {

                    $msg->closed = 1;

                    $msg->save(false);

                }

            }


        }

    }

}