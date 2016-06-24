<?php
namespace frontend\controllers\widgets;

use common\components\Email;
use common\models\Subscribers;
use common\models\Unsubscribe;
use Yii;
use frontend\models\StudyguideSubscribe;

class NewsletterController{

    public function init( &$params ){

        $model = new StudyguideSubscribe();

        $params["model"] = $model;


    }

    public function ajax(){

        $return = [];

        if( Yii::$app->request->post("studyguide_subscribe") ){

            $model = new StudyguideSubscribe();

            if( Yii::$app->request->post('onlyemail') ){
                $model->scenario = 'onlyemail';
            } else {
                $model->scenario = 'main';
            }

            if( $model->load(Yii::$app->request->post()) && $model->validate() ){

                $subscribers = new Subscribers();

                $subscribers->email = $model->email;
                $subscribers->date = date("Y-m-d H:i:s");
                $subscribers->slug = "studyguide";
                $subscribers->info = serialize( isset($model->attributes) ? $model->attributes : [] );

                $subscribers->save( false );

                Unsubscribe::deleteAll("`email`='".$model->email."'");

                $return["response"] = "ok";

            } else {

                $return["response"] = "error";
                $return["errors"] = $model->getErrors();

            }

        }

        return json_encode( $return );

    }

}