<?php
namespace backend\components;


class RestoreGET{

    public static function restore( ){

        $controllerID = \Yii::$app->controller->id;
        $actionID = \Yii::$app->controller->action->id;

        $session = \Yii::$app->session;

        if ( !$session->isActive ) $session->open();

        if( !isset($_SESSION["restoreGET"]) )
            $_SESSION["restoreGET"] = [];

        if( !isset($_SESSION['restoreGET'][$controllerID.'_'.$actionID]) )
            $_SESSION['restoreGET'][$controllerID.'_'.$actionID] = [];

        foreach( $_GET as $index=>$value ){

            $_SESSION['restoreGET'][$controllerID.'_'.$actionID][ $index ] = $value;

        }

        $_GET = $_SESSION['restoreGET'][$controllerID.'_'.$actionID];

        if( isset( \Yii::$app->params["default_filters"][$controllerID."_".$actionID] ) )
            foreach( \Yii::$app->params["default_filters"][$controllerID."_".$actionID] as $index=>$value ){

                foreach( $value as $index2=>$value2 ){

                    if( !isset( $_GET[ $index ][$index2] ) ){
                        $_GET[ $index ][$index2] = $value2;
                    }

                }

            }

    }

}