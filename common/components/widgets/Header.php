<?php

namespace common\components\widgets;

class Header extends \common\components\Widget{

    public $viewFile = 'header';

    public function params(){

        $params = [
            [
                "slug" => "style",
                "type" => "selectbox",
                "label" => "Style",
                "values" => [
                    "1" => "Style 1",
                    "2" => "Style 2",
                    "3" => "Style 3",
                    "4" => "Style 4",
                ],
                "default" => "1",
            ]
        ];

        return $params;

    }

}