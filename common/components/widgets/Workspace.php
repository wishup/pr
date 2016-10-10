<?php

namespace common\components\widgets;

class Workspace extends \common\components\Widget{

    public $viewFile = 'workspace';

    public function params(){

        $params = [
            [
                "slug" => "image",
                "type" => "file",
                "label" => "Images",
                "default" => "",
                "multiple" => true
            ],
        ];

        return $params;

    }

}