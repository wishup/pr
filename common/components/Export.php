<?php
namespace common\components;
use moonland\phpexcel\Excel;

class Export{

    public static function strip_html( $val ){

        $action = \Yii::$app->request->post('action') ? \Yii::$app->request->post('action') : 'view';

        if( $action == 'download_xls' ){

            $val = strip_tags($val);

        }

        return $val;

    }

    public static function strip_html_tags( $val ){

        $action = \Yii::$app->request->post('action') ? \Yii::$app->request->post('action') : 'view';

        if( $action == 'download_xls' ){

            $val = str_replace(['<', '>'], '', $val);

        }

        return $val;

    }

    public function excel( $data ){

        $data["dataProvider"]->pagination->pageSize=-1;

//        $attributes = array();
//        $model = $data['dataProvider']->getModels();
//        foreach($model[0]->attributes as $attr=>$val){
//            $attributes[] = $attr;
//        }
//        $columns = array();
//
//        foreach($attributes as $attr){
//            if (isset($data['exclude_exel']) && !in_array($attr, $data['exclude_exel'])) {
//                $columns[] = $attr;
//                if(isset($data['related'])){
//                    foreach($data['related'] as $related=>$val){
//                        if($related == $attr){
//                            $columns[] = $val;
//                            $unset_index = array_search($attr, $columns);
//                            unset($columns[$unset_index]);
//                        }
//                    }
//                }
//            }
//        }

        $columns = [];

        foreach( $data["grid_fields"] as $field ){

            if( is_array($field) && isset($field["class"]) && ( $field["class"] == 'yii\grid\ActionColumn' || $field["class"] == 'yii\grid\SerialColumn' ) ) continue;
            if( is_array($field) && isset($field["class"]) && ( !isset($field["value"]) || !isset($field["attribute"]) ) ) continue;
            if( is_array($field) && isset($field["format"]) && $field["format"] == 'raw' ) continue;

            if( is_array($field) ){

                $field["format"] = 'text';

                $field_val = $field;

            } else {

                $field_arr = explode(":", $field);

                $field_val = $field_arr[0].':text';

            }

            $columns[] = $field_val;

        }

        \moonland\phpexcel\Excel::widget([
            'models' => $data['dataProvider']->getModels(),
            'mode' => 'export',
            'columns' => $columns,
            "fileName" => \Yii::$app->controller->id.date("Y-m-d H:i:s").'.xlsx'
        ]);
    }

}