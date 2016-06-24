<?php
namespace common\components;

use common\models\SeoSettings;
use common\models\SeoParameters;
use common\models\Options;

class Settings{

    public function renderSettingsBlock( $args ){

        $page_url = str_replace('{model_id}', $args["model_id"], $args["default_url_template"]);

        if( $rewrite_url_model = SeoSettings::find()->where("default_url='".$page_url."'")->one() ){
            $rewrite_url = $rewrite_url_model->rewrite_url;
        } else {
            $rewrite_url = '';
        }

        if( $meta_model = SeoParameters::find()->where("url='".$page_url."'")->one() ){
            $title = $meta_model->title;
            $meta_description = $meta_model->meta_description;
            $meta_keywords = $meta_model->meta_keywords;
        } else {
            $title = '';
            $meta_description = '';
            $meta_keywords = '';
        }



        $args['rewrite_url'] = $rewrite_url;
        $args['title'] = $title;
        $args['meta_description'] = $meta_description;
        $args['meta_keywords'] = $meta_keywords;

        return \Yii::$app->controller->renderPartial('//elements/settings_block', $args);

    }

    public function saveSettingsBlock( $model_id ){

        $page_url = str_replace('{model_id}', $model_id, \Yii::$app->request->post('ps')["default_url_template"]);

        if( !$seo_model = SeoSettings::find()->where("default_url='".$page_url."'")->one() ){

            $seo_model = new SeoSettings();

        }

        $seo_model->default_url = $page_url;
        $seo_model->rewrite_url = \Yii::$app->request->post('ps')["rewrite_url"];

        if( !$meta_model = SeoParameters::find()->where("url='".$page_url."'")->one() ){

            $meta_model = new SeoParameters();

        }

        $meta_model->url = $page_url;
        $meta_model->title = \Yii::$app->request->post('ps')["title"];
        $meta_model->meta_description = \Yii::$app->request->post('ps')["meta_description"];
        $meta_model->meta_keywords = \Yii::$app->request->post('ps')["meta_keywords"];

        if( ( $seo_model->rewrite_url!='' && !$seo_model->save()) || ( ( $meta_model->title!='' || $meta_model->meta_description!='' || $meta_model->meta_keywords!='' ) && !$meta_model->save() ) ){

            $errors = '';

            foreach( $seo_model->errors as $err_arr )
                foreach( $err_arr as $err )
                    $errors .= $err.'<br>';

            foreach( $meta_model->errors as $err_arr )
                foreach( $err_arr as $err )
                    $errors .= $err.'<br>';

            \Yii::$app->session->setFlash('error', $errors);

            return false;

        }

        return true;

    }

    public function renderOptionsBlock( $model, $model_id ){

        if( !$model_id ) return false;

        $args = [];

        if( $options = Options::find()->where("`model`='".$model."' AND `model_id`=".$model_id)->orderBy("key")->all() ){

            foreach( $options as $option ){

                $args[] = [
                    "key" => self::slugToTitle( $option->key ),
                    "value" => $option->value,
                ];

            }

        }

        return count($args) > 0 ? \Yii::$app->controller->renderPartial('//elements/options_block', ["options"=>$args]) : '';

    }

    public static function slugToTitle( $slug ){

        $slug = ucfirst( str_replace("_", " ", $slug) );

        return $slug;

    }

}