<?php
namespace backend\controllers;

use common\models\Seasons;
use Yii;
use yii\base\Exception;
use yii\grid\GridView;
use yii\web\Controller;

/**
 * Base controller
 */
class BaseController extends Controller
{

    public $gridSettings = [
        "summary" => true,
        "download_buttons" => true,
        "items" => true,
        "pager" => true,
        "bulk_actions" => false,
        "page_size" => true,
        "before" => false,
        "after" => false,
    ];

    public function afterAction($action, $result)
    {
        $result = parent::afterAction($action, $result);

        if( !\Yii::$app->request->isAjax && $action->id != 'error' && !\Yii::$app->user->isGuest ) {

            $canadd = true;

            if( $f = \backend\models\RecentUrls::find()->where("user_id=".\Yii::$app->user->identity->id)->orderBy("id desc")->limit(1)->one() ) {

                if( $f->url == $_SERVER["REQUEST_URI"] ){
                    $canadd = false;
                }

            }

            if( $canadd ){

                $recent = new \backend\models\RecentUrls();
                $recent->url = $_SERVER["REQUEST_URI"];
                $recent->user_id = \Yii::$app->user->identity->id;
                $recent->title = $this->view->title;
                $recent->save();

                $urls = \backend\models\RecentUrls::find()->where("user_id=".\Yii::$app->user->identity->id)->orderBy("id desc")->offset(30)->all();

                foreach( $urls as $url )
                    $url->delete();

            }
        }
        return $result;
    }



    public function dynamic_render( $template, $data, $partial = false ){

        $request = Yii::$app->request;
        $action = $request->post('action') ? $request->post('action') : 'view';

        switch( $action ){

            case 'download_xls':

                $excel = new \common\components\Export();

                return $excel->excel( $data );

                break;

            default:

                if( isset($data["grid_settings"]) )
                    foreach( $data["grid_settings"] as $index=>$value )
                        $this->gridSettings[ $index ] = $value;

                $this->GridViewSettings();

                $gridparams = [
                    'dataProvider' => $data['dataProvider'],
                    'columns' => $data['grid_fields'],
                ];

                if( isset( $data['searchModel'] ) ) $gridparams['filterModel'] = $data['searchModel'];

                $grid_view = GridView::widget($gridparams);

                $data['grid_view'] = $grid_view;

                return $partial ? $this->renderPartial($template, $data) : $this->render($template, $data);

                break;

        }

    }

    public function beforeAction($action)
    {
        $layout = '{summary}<br>';
        $layout .= '{items}<br>';
        $layout .= '<div class="row">';
        $layout .= '<div class="col-md-9" style="padding-top:13px;">{pager}</div>';
        $layout .= '<div class="col-md-2 col-md-offset-1">'.\backend\components\PageSize::widget(["options"=>["class"=>"form-control"], 'defaultPageSize'=> 50]).'</div>';
        $layout .= '</div>';

        \Yii::$container->set('yii\grid\GridView', [
            'tableOptions' => [
                'class' => 'table table-striped table-bordered table-bordered-users table-white-bg',
            ],
            'layout' => $layout,
        ]);

        return parent::beforeAction($action);
    }

    public function GridViewSettings(){

        $settings = $this->gridSettings;

        $layout = '';

        if( $settings["before"] ) $layout .= $settings["before"];

        $layout .= '<div class="gridview_top">';
            $layout .= '<table class="table">';
                $layout .= '<tr>';
                    if( $settings["summary"] ) $layout .= '<td>{summary}</td>';
                $layout .= '</tr>';
            $layout .= '</table>';
        $layout .= '</div>';

        if( $settings["items"] ) $layout .= '<div>{items}</div>';

        $layout .= '<div class="gridview_bottom">';
            $layout .= '<table class="table">';
                $layout .= '<tr>';
                    if( $settings["page_size"] ) $layout .= '<td>'.\backend\components\PageSize::widget(["options"=>["class"=>"form-control"], 'defaultPageSize'=> 50]).'</td>';
                    if( $settings["pager"] ) $layout .= '<td>{pager}</td>';
                    if( $settings["bulk_actions"] ) $layout .= '<td>'.$settings["bulk_actions"].'</td>';
                    if( $settings["download_buttons"] ) $layout .= '<td>'.$this->renderPartial('//elements/download_buttons').'</td>';
                $layout .= '</tr>';
            $layout .= '</table>';
        $layout .= '</div>';

        if( $settings["after"] ) $layout .= $settings["after"];


        \Yii::$container->set('yii\grid\GridView', [
            'tableOptions' => [
                'class' => 'table table-striped table-bordered table-bordered-users table-white-bg',
            ],
            'layout' => $layout,
        ]);

    }


}
