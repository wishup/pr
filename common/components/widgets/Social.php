<?php

namespace common\components\widgets;

class Social extends \common\components\Widget{

    public $viewFile = 'social';

    public function params(){

        $params = [
            [
                "slug" => "title",
                "type" => "text",
                "label" => "Title",
                "default" => "Share",
            ],
        ];

        return $params;

    }

}