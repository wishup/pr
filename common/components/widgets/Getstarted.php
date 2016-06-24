<?php

namespace common\components\widgets;

class Getstarted extends \common\components\Widget{

    public $viewFile = 'getstarted';

    public function params(){

        $params = [
            [
                "slug" => "type",
                "type" => "selectbox",
                "label" => "Type",
                "values" => [
                    "host" => "Host registration",
                    "family" => "Family registration",
                ],
                "default" => "host",
            ],
        ];

        return $params;

    }

}