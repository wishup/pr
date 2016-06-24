<?php

namespace common\components\widgets;

use Yii;
use common\models\Subscribers;

class Newsletter extends \common\components\Widget{

    public $viewFile = 'newsletter';

    public function __construct(){

        $this->controller();

    }

    public function params(){

        $params = [
            [
                "slug" => "title",
                "type" => "text",
                "label" => "Title",
                "default" => "Sign up for News & special offers",
            ],
            [
                "slug" => "popup",
                "type" => "checkbox",
                "label" => "More info popup",
                "default" => "0",
            ],
        ];

        return $params;

    }

    public function controller(){

        $model = new Subscribers();
        if(Yii::$app->request->post('subscribe')){
            $model->email = Yii::$app->request->post('email');
            $model->date = date("Y-m-d H:i:s");
            $model->save();
        }

    }

}