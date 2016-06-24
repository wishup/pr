<?php

namespace common\components\widgets;

class Banner_with_text extends \common\components\Widget{

    public $viewFile = 'banner_with_text';

    public function params(){

        $params = [
            [
                "slug" => "type",
                "type" => "selectbox",
                "label" => "Type",
                "values" => [
                    "1" => "With Headings",
                    "2" => "With Quote",
                ],
                "default" => "1",
            ],
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
            [
                "slug" => "text_filed_1",
                "type" => "textarea",
                "label" => "Text Field 1",
                "default" => "",
            ],
            [
                "slug" => "text_filed_2",
                "type" => "text",
                "label" => "Text Field 2",
                "default" => "",
            ],
        ];

        return $params;

    }

}