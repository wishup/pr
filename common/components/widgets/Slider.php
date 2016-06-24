<?php

namespace common\components\widgets;

use common\models\Sliders;
use yii\db\ActiveQuery;

class Slider extends \common\components\Widget{

    public $viewFile = 'slider';

    public function params(){

        $sliders = Sliders::find()->all();
        $slider_names = array();
        if($sliders) {
            foreach ($sliders as $item) {
                $slider_names[$item->id] = $item->name;
            }
        }

        $params = [
            [
                "slug" => "slider_name",
                "type" => "selectbox",
                "label" => "Slider Name",
                "values" => $slider_names,
                "default" => "0",
            ]
        ];

        return $params;

    }

}