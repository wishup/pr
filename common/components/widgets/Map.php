<?php

namespace common\components\widgets;

class Map extends \common\components\Widget{

    public $viewFile = 'map';

    public function params(){

        $params = [
            [
                "slug" => "type",
                "type" => "selectbox",
                "label" => "Type",
                "values" => [
                    "hosts_map" => "Hosts map",
                ],
                "default" => "hosts_map",
            ],
            [
                "slug" => "design",
                "type" => "selectbox",
                "label" => "Design version",
                "values" => [
                    "public" => "Public",
                    "dashboard" => "Dashboard",
                    "registration" => "Registration",
                ],
                "default" => "hosts_map",
            ],
            [
                "slug" => "disable_join",
                "type" => "checkbox",
                "label" => "Disable JOIN button",
                "default" => "0",
            ],
            [
                "slug" => "show_google_plus_button",
                "type" => "checkbox",
                "label" => "Show Google + button",
                "default" => "0",
            ],
        ];

        return $params;

    }

}