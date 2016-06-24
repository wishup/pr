<?php
namespace backend\models;

use Yii;

class TempModel extends \yii\base\Model{

    private $dynamic_values;
    private $attrLabels;

    public function __set($name, $value){

        $this->dynamic_values[ $name ] = $value;

    }

    public function __get($name){

        return isset( $this->dynamic_values[ $name ] ) ? $this->dynamic_values[ $name ] : 'aaa';

    }

    public function attributeLabels()
    {
        return $this->attrLabels;
    }

    public function setLabels( $labels ){

        foreach( $labels as $index=>$value ){

            $this->attrLabels["column_".$index] = $value;

        }

    }

}