<?php
namespace frontend\controllers;

use Yii;
use yii\base\Exception;
use yii\web\Controller;
use common\models\SeoParameters;
use common\models\SeoSettings;
use common\models\Layouts;
use common\models\LayoutsSettings;
use common\models\LayoutsWidgetsAreas;
use common\models\WidgetsInLayouts;

/**
 * Base controller
 */
class BaseController extends Controller
{

    public function bindActionParams ( $action, $params )
    {


        $parse_url_str = parse_url(Yii::$app->request->url);
        $query = isset($parse_url_str['query'])? '?'.$parse_url_str['query'] : "";

        $request_url = trim($parse_url_str['path'], '/');

        //Setting selected URLs array for menu items

        \Yii::$app->params['active_urls'] = [];
        \Yii::$app->params['active_urls'][] = '/'.$request_url;
        $request_url = addslashes(stripslashes($request_url));

        if( $seo = SeoSettings::find()->where("rewrite_url='".$request_url."'")->one() ){

            \Yii::$app->params['active_urls'][] = '/'.$seo->default_url;

        }

        // Redirect to rewrite url
        if( $seo = SeoSettings::find()->where("default_url='".$request_url."' and rewrite_url!=''")->one() ) {

            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".'/'.$seo->rewrite_url.$query);
            exit;

        }


        // SEO settings

        $where = " '".$request_url."' LIKE concat(url,'%') ";

        if( $seo = SeoSettings::find()->where("rewrite_url='".$request_url."'")->one() ) {
            $where .= " OR '" . $seo->default_url . "' LIKE concat(url,'%') ";
        }

        if( $seoparams = SeoParameters::find()->where( $where )->orderBy('LENGTH(`url`) DESC')->limit(1)->one() ){

            $title = $this->replace_short_codes( $seoparams->title , $action );
            $meta_description = $this->replace_short_codes( $seoparams->meta_description , $action );
            $meta_keywords = $this->replace_short_codes( $seoparams->meta_keywords , $action );

        } else {

            $title = 'Default';
            $meta_description = 'Default';
            $meta_keywords = 'Default';

        }

        $this->view->title = $title;
        $this->view->registerMetaTag([
            'name' => 'description',
            'content' => $meta_description
        ]);
        $this->view->registerMetaTag([
            'name' => 'keywords',
            'content' => $meta_keywords
        ]);

        // Layout settings

        if( $request_url != '' ){

            $layoutmodel = Layouts::find()->where( $where )->orderBy('LENGTH(`url`) DESC')->limit(1)->one();

        } else {

            if( !$layoutmodel = Layouts::find()->where( "homepage=1" )->one() ){

                $layoutmodel = Layouts::find()->where( $where )->orderBy('LENGTH(`url`) DESC')->limit(1)->one();

            }

        }

        if( $layoutmodel ){

            $readLayouts = [ $layoutmodel->id ];

            if( (int)$layoutmodel->parent_id > 0 ){

                $layout_parent = $layoutmodel->parent_id;

                while( $layout_parent > 0 ){

                    $readLayouts[] = $layout_parent;

                    $playout = Layouts::find()->where("id=".$layout_parent)->one();

                    $layout_parent = (int)$playout->parent_id;

                }

            }

            $layout_settings_model = LayoutsSettings::find()->where("layout_id IN (".implode(',', $readLayouts).")")->orderBy("id")->all();

            $layout_settings = [];

            foreach( $layout_settings_model as $ls )
                $layout_settings[ $ls->key ] = $ls->value;

            $layout_widgareas_model = WidgetsInLayouts::find()->where("layout_id=".$layoutmodel->id." AND active=1")->orderBy("order")->all();

            $layout_widgets = [];

            foreach( $layout_widgareas_model as $ls ) {

                if( !isset($layout_widgets[$ls->position]) ) $layout_widgets[$ls->position] = array();
                $layout_widgets[$ls->position][] = $ls->id;

            }

            $this->layout = $layoutmodel->layout_file ? $layoutmodel->layout_file : 'main';

            \Yii::$app->view->params['layout_settings'] = array();

            \Yii::$app->view->params['layout_settings']['settings'] = $layout_settings;
            \Yii::$app->view->params['layout_settings']['widgets'] = $layout_widgets;

        } else
            throw new Exception('Layout not found');

        $this->callWidgetsAjax();

        return parent::bindActionParams($action, $params);
    }

    private function replace_short_codes( $str, $action ){

        $controller_id = $action->controller->id;
        $action_id = $action->id;

        $str = str_replace('<%controller%>', $controller_id, $str);
        $str = str_replace('<%action%>', $action_id, $str);
        $str = str_replace('<%separator%>', \Yii::$app->params['seo_title_separator'], $str);

        return $str;

    }

    private function callWidgetsAjax(){

        if( Yii::$app->request->post("widget_ajax") ){

            $class = '\\frontend\\controllers\\widgets\\'.Yii::$app->request->post("widget_ajax").'Controller';

            $controller = new $class();

            echo $controller->ajax();

            exit;

        }

    }

    public function beforeAction($action)
    {

        $user_id = \common\models\Users::user_id();

        $publicActions = Yii::$app->params["publicActions"];

        if ( !$user_id && ( !isset($publicActions[ $action->controller->id ]) || ( !in_array( $action->id, $publicActions[ $action->controller->id ] ) && !in_array( "*", $publicActions[ $action->controller->id ] ) ) ) ) {

            header("Location: /user/login");

            exit;

        }

        return parent::beforeAction($action);
    }

}
