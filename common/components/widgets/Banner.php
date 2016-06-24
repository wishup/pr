<?php

namespace common\components\widgets;

class Banner extends \common\components\Widget{

    public $viewFile = 'banner';

    public function params(){

        $params = [
            [
                "slug" => "url",
                "type" => "text",
                "label" => "URL",
                "default" => "http://",
            ],
            [
                "slug" => "target_blank",
                "type" => "checkbox",
                "label" => "Open in new tab",
                "default" => "0",
            ],
            [
                "slug" => "image",
                "type" => "file",
                "label" => "Image",
                "default" => "",
            ],
        ];

        return $params;

    }

}