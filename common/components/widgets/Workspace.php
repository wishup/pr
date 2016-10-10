<?php

namespace common\components\widgets;

use common\models\Gallery;

class Workspace extends \common\components\Widget{

    public $viewFile = 'workspace';

    public function params(){

        $galleries = [];

        if( $galmodels = Gallery::find()->all() ){

            foreach( $galmodels as $galmodel )
                $galleries[ $galmodel->id ] = $galmodel->name;

        }

        $params = [
            [
                "slug" => "gallery_id",
                "type" => "selectbox",
                "label" => "Gallery",
                "values" => $galleries,
                "default" => "2",
            ]
        ];

        return $params;

    }

}