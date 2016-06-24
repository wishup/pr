<?php

namespace common\components\widgets;

class home_sections extends \common\components\Widget{

    public $viewFile = 'home_sections';

    public function params(){

        $params = [
            [
                "slug" => "bg_1",
                "type" => "file",
                "label" => "Section Background 1",
                "default" => "",
            ],
            [
                "slug" => "text_1",
                "type" => "textarea",
                "label" => "First Textfield",
                "default" => "",
            ],
            [
                "slug" => "text_2",
                "type" => "textarea",
                "label" => "Second Textfield",
                "default" => "",
            ],
            [
                "slug" => "button_text_1",
                "type" => "text",
                "label" => "button Text",
                "default" => "",
            ],
            [
                "slug" => "button_link_1",
                "type" => "text",
                "label" => "button Link",
                "default" => "",
            ],
            [
                "slug" => "text_3",
                "type" => "textarea",
                "label" => "Third Textfield",
                "default" => "",
            ],
            [
                "slug" => "bg_2",
                "type" => "file",
                "label" => "Section Background 2",
                "default" => "",
            ],
            [
                "slug" => "text2_1",
                "type" => "textarea",
                "label" => "First Textfield",
                "default" => "",
            ],
            [
                "slug" => "text2_2",
                "type" => "textarea",
                "label" => "Second Textfield",
                "default" => "",
            ],
            [
                "slug" => "quote",
                "type" => "textarea",
                "label" => "Quote Field",
                "default" => "",
            ],
            [
                "slug" => "quote_author",
                "type" => "text",
                "label" => "Quote Author",
                "default" => "",
            ],
            [
                "slug" => "button_text_2",
                "type" => "text",
                "label" => "button Text",
                "default" => "",
            ],
            [
                "slug" => "button_link_2",
                "type" => "text",
                "label" => "button Link",
                "default" => "",
            ],
            [
                "slug" => "bg_2_c",
                "type" => "file",
                "label" => "Contestant Background 2",
                "default" => "",
            ],
            [
                "slug" => "text2_1_c",
                "type" => "textarea",
                "label" => "Contestant First Textfield",
                "default" => "",
            ],
            [
                "slug" => "text2_2_c",
                "type" => "textarea",
                "label" => "Contestant Second Textfield",
                "default" => "",
            ],
            [
                "slug" => "quote_c",
                "type" => "textarea",
                "label" => "Contestant Quote Field",
                "default" => "",
            ],
            [
                "slug" => "quote_author_c",
                "type" => "text",
                "label" => "Contestant Quote Author",
                "default" => "",
            ],
            [
                "slug" => "button_text_2_c",
                "type" => "text",
                "label" => "Contestant button Text",
                "default" => "",
            ],
            [
                "slug" => "button_link_2_c",
                "type" => "text",
                "label" => "Contestant button Link",
                "default" => "",
            ],
            [
                "slug" => "bg_3",
                "type" => "file",
                "label" => "Section Background 3",
                "default" => "",
            ],
            [
                "slug" => "text3_1",
                "type" => "textarea",
                "label" => "First Textfield",
                "default" => "",
            ],
            [
                "slug" => "text3_2",
                "type" => "textarea",
                "label" => "Second Textfield",
                "default" => "",
            ],
            [
                "slug" => "iframe",
                "type" => "text",
                "label" => "Iframe",
                "default" => "",
            ],

        ];

        return $params;

    }

}