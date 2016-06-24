<?php

namespace common\components\widgets;

class Gameshow extends \common\components\Widget{

    public $viewFile = 'gameshow';

    public function params(){

        $params = [
            [
                "slug" => "bg",
                "type" => "file",
                "label" => "Section Background",
                "default" => "",
            ],
            [
                "slug" => "gameshow_logo",
                "type" => "file",
                "label" => "Gameshow Logo",
                "default" => "",
            ]
        ];

        return $params;

    }

}