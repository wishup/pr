<?php

namespace common\components\widgets;

class Textblock extends \common\components\Widget{

    public $viewFile = 'textblock';

    public function params(){

        $params = [
            [
                "slug" => "content",
                "type" => "textarea",
                "label" => "Content",
                "default" => "",
                "wysiwyg" => true
            ],
        ];

        return $params;

    }

}