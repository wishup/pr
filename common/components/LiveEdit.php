<?php
namespace common\components;

use common\models\LiveEditTexts;
use yii\web\Session;

class LiveEdit{

    public static function text( $file, $word, $wrapper = 'span', $format = 'text' ){

        $overrided_text = self::getOverridedTexts();

        $key = md5( $file.$word );

        if( isset($overrided_text[ $key ]) ){

            $value = $overrided_text[ $key ]->content;

        } else {

            self::saveNewText( $key, $word );

            $value = $word;

        }

        if( self::status() ){

            if( self::inline_status() ) {

                $keymodel = \common\models\LiveEditTexts::find()->where("`key`='".$key."'")->one();

                $val = '<' . $wrapper . ' class="live_edit_field_inline" data-url="/backend/live-edit-texts/update?id='.$keymodel->id.'">';
                $val .= $value;
                $val .= '</' . $wrapper . '>';

                return $val;

            } else {

                $val = '<' . $wrapper . ' class="live_edit_field" data-source="file" data-token="' . $key . '" data-format="' . $format . '" data-editing="0">';
                $val .= $value;
                $val .= '</' . $wrapper . '>';

                return $val;

            }

        } else
            return $value;

    }

    public static function widgetField( $value, $index, $model_id, $format = "text", $wrapper = 'span' ){

        return \common\components\LiveEdit::field( $value, "\\common\\models\\WidgetsInLayouts", $model_id, "params", $format, "serialize", $index, $wrapper );

    }

    public static function field( $value , $modelClass, $model_id, $fieldName, $format = 'text', $encoded = '', $index = '', $wrapper = 'div' ){

        if( self::status() ){

            if( self::inline_status() ) {

                $val = '<' . $wrapper . ' class="live_edit_field_inline" data-url="/backend/live-edit-texts/updatefield?model='.$modelClass.'&model_id='.$model_id.'&field_name='.$fieldName.'&format='.$format.'&encoded='.$encoded.'&index='.$index.'">';
                $val .= $value;
                $val .= '</' . $wrapper . '>';

                return $val;

            } else {

                $livemodel = new \common\models\LiveEdit();

                $livemodel->token = md5($modelClass . $model_id . $fieldName . time() . rand(0, 100000));
                $livemodel->date = date("Y-m-d H:i:s");
                $livemodel->model = $modelClass;
                $livemodel->model_id = $model_id;
                $livemodel->field = $fieldName;
                $livemodel->encoded = $encoded;
                $livemodel->index = $index;

                $livemodel->save(false);

                $val = '<' . $wrapper . ' class="live_edit_field" data-source="db" data-token="' . $livemodel->token . '" data-format="' . $format . '" data-editing="0">';
                $val .= $value;
                $val .= '</' . $wrapper . '>';

                return $val;

            }

        } else
            return $value;

    }

    public static function on(){

        $session = \Yii::$app->session;

        $session["liveedit_status"] = 'on';

        return true;

    }

    public static function off(){

        $session = \Yii::$app->session;

        unset( $session["liveedit_status"] );

        return true;

    }

    public static function status(){

        $session = \Yii::$app->session;

        return isset( $session["liveedit_status"] );

    }


    public static function inline_on(){

        $session = \Yii::$app->session;

        $session["liveedit_inline_status"] = 'on';

        return true;

    }

    public static function inline_off(){

        $session = \Yii::$app->session;

        unset( $session["liveedit_inline_status"] );

        return true;

    }

    public static function inline_status(){

        $session = \Yii::$app->session;

        return isset( $session["liveedit_inline_status"] );

    }

    public static function admin(){

        $session = \Yii::$app->session;

        return isset($session["__id"]);

    }

    public static function saveArray( $filePath, $array ){

        file_put_contents($filePath, "<?php\n\nreturn ".var_export($array, true).";");

        return true;

    }

    public static function getOverridedTexts(){

        if( !isset( \Yii::$app->params["live_edit_texts"] ) ){

            $texts = LiveEditTexts::find()->indexBy("key")->all();

            \Yii::$app->params["live_edit_texts"] = $texts;

        } else {

            $texts = \Yii::$app->params["live_edit_texts"];

        }

        return $texts;

    }

    public static function saveNewText( $key, $word ){

        $textmodel = new LiveEditTexts;

        $textmodel->key = $key;
        $textmodel->content = $word;

        $textmodel->save( false );

    }

    public static function updateTexts( $changes ){

        $overrided_text = self::getOverridedTexts();

        foreach ( $changes as $token => $content ) {

            if( $overrided_text[ $token ] != $content ){

                $textmodel = LiveEditTexts::find()->where("`key`='".$token."'")->one();

                $textmodel->content = $content;

                $textmodel->save( false );

                $overrided_text[ $token ] = $textmodel;

            }

        }

    }

}