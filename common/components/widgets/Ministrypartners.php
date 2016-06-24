<?php

namespace common\components\widgets;

class Ministrypartners extends \common\components\Widget{

    public $viewFile = 'ministrypartners';

    public function params(){

        $params = [
            [
                "type" => "group",
                "label" => "Partner",
                "slug" => "partner",
                "fields" => [
                    [
                        "slug" => "name",
                        "type" => "text",
                        "label" => "Name",
                        "default" => "",
                    ],
                    [
                        "slug" => "description",
                        "type" => "text",
                        "label" => "Description",
                        "default" => "",
                    ],
                    [
                        "slug" => "url",
                        "type" => "text",
                        "label" => "URL",
                        "default" => "",
                    ],
                ]
            ],
        ];

        return $params;

    }

}