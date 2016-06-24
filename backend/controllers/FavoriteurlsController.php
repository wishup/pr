<?php

namespace backend\controllers;

use backend\models\FavoriteUrls;
use yii;

class FavoriteurlsController extends BaseController
{
    public function actionAdd()
    {
        $result = 0;

        if( Yii::$app->request->post('url') && Yii::$app->request->post('title') ) {

            $url_parts = parse_url(Yii::$app->request->post('url'));

            $url = new FavoriteUrls();

            $url->user_id = Yii::$app->user->identity->id;
            $url->url = $url_parts["path"];
            $url->title = Yii::$app->request->post('title');

            if( $url->save() ) {

                $result = $url_parts["path"];

            }

        }

        echo $result;

        die;
    }

    public function actionRemove()
    {
        $result = 0;

        if( Yii::$app->request->post('url') ) {

            $url_parts = parse_url(Yii::$app->request->post('url'));

            FavoriteUrls::deleteAll('user_id = '.Yii::$app->user->identity->id." and url='".$url_parts["path"]."'");

            $result = $url_parts["path"];

        }

        echo $result;

        die;
    }

    public function beforeAction($action)
    {
        if ($action->id == 'add' || $action->id == 'remove') {
            Yii::$app->controller->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }

}
