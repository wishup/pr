<?php

namespace backend\controllers;

use Yii;
use common\models\Layouts;
use common\models\LayoutsWidgetsAreas;
use backend\models\Widgets;
use yii\base\Widget;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\LayoutsSettings;
use common\models\WidgetsInLayouts;
use backend\models\WidgetsAreas;
use yii\filters\AccessControl;

/**
 * LayoutsController implements the CRUD actions for Layouts model.
 */
class LayoutsController extends BaseController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Layouts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new Layouts();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('//layout/index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }

    /**
     * Displays a single Layouts model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('//layout/view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Layouts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Layouts();

        $widgets = Widgets::find()->orderBy('title')->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $this->saveSettings( $model );

            $default_settings = [
                "section_top_active" => "1",
                "section_left_active" => "1",
                "section_right_active" => "1",
                "section_bottom_active" => "1",
                "section_center_active" => "1",
            ];

            foreach( $default_settings as $ds_key => $ds_val ){

                $sett = new LayoutsSettings();

                $sett->layout_id = $model->id;
                $sett->key = $ds_key;
                $sett->value = $ds_val;

                $sett->save();

            }

            return $this->redirect(['update', 'id'=>$model->id]);
        } else {

            $widgets_areas = WidgetsAreas::find()->all();
            $layout_widgets = [];

            return $this->render('//layout/create', [
                'model' => $model,
                'widgets_areas' => $widgets_areas,
                'widgets' => $widgets,
                'layout_widgets' => $layout_widgets,
            ]);
        }
    }

    /**
     * Updates an existing Layouts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $widgets = Widgets::find()->orderBy('title')->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $this->saveSettings( $model );

            return $this->redirect(['update', 'id'=>$id]);
        } else {

            $settings = LayoutsSettings::find()->where("layout_id=".$id)->indexBy("key")->all();
            $widgets_areas = WidgetsAreas::find()->all();
            $layout_widgets = LayoutsWidgetsAreas::find()->where("layout_id=".$model->id)->all();

            return $this->render('//layout/update', [
                'model' => $model,
                'settings' => $settings,
                'widgets_areas' => $widgets_areas,
                'widgets' => $widgets,
                'layout_widgets' => $layout_widgets,
            ]);
        }
    }

    /**
     * Deletes an existing Layouts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Layouts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Layouts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Layouts::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    private function saveSettings($model){

        if( Yii::$app->request->post('ls') ){

            foreach( Yii::$app->request->post('ls') as $key=>$value ){

                if( !$ls_model = LayoutsSettings::find()->where("`layout_id`=".$model->id." AND `key`='".$key."'")->one() ){
                    $ls_model = new LayoutsSettings();
                }

                $ls_model->layout_id = $model->id;
                $ls_model->key = $key;
                $ls_model->value = $value;

                $ls_model->save();

            }

        }

        LayoutsWidgetsAreas::deleteAll('layout_id = '.$model->id);

        if( Yii::$app->request->post('wd') ){

            foreach( Yii::$app->request->post('wd') as $section=>$widget_areas ){

                foreach( $widget_areas as $wa_id ){

                    if( (int)$wa_id <= 0 ) continue;

                    $layout_wid_area = new LayoutsWidgetsAreas();

                    $layout_wid_area->layout_id = $model->id;
                    $layout_wid_area->section = $section;
                    $layout_wid_area->widget_area_id = $wa_id;

                    $layout_wid_area->save();

                }

            }

        }

    }

    public function beforeAction($action)
    {
        Yii::$app->controller->enableCsrfValidation = false;

        return parent::beforeAction($action);
    }

    public function actionExtandinfo(){

        if( Yii::$app->request->post('layout_id') ){

            $json = [];
            $json["widgets"] = [];
            $json["settings"] = [];

            $layouts = [ (int)Yii::$app->request->post('layout_id') ];

            $play = Layouts::find()->where("id=".(int)Yii::$app->request->post('layout_id'))->one();

            $layout_parent = (int)$play->parent_id;

            while( $layout_parent > 0 ){

                $layouts[] = $layout_parent;

                $play = Layouts::find()->where("id=".$layout_parent)->one();

                $layout_parent = (int)$play->parent_id;

            }

            $layout_widgets = LayoutsWidgetsAreas::find()->where("layout_id IN (".implode(",", $layouts).")")->all();

            foreach( $layout_widgets as $lw ){

                $json["widgets"][] = [
                    "section" => $lw->section,
                    "widget_area_id" => $lw->widget_area_id,
                ];

            }

            $layout_settings = LayoutsSettings::find()->where("layout_id=".(int)Yii::$app->request->post('layout_id'))->all();

            foreach( $layout_settings as $ls ){

                $json["settings"][ $ls->key ] = $ls->value;

            }

            echo json_encode( $json );

            die;

        }

        return false;

    }

    public function actionSavewidget(){

        $json = array();

        if(
            Yii::$app->request->post('widget_slug') &&
            Yii::$app->request->post('widget_position') &&
            Yii::$app->request->post('widget_title') &&
            Yii::$app->request->post('layout_id')
        ){

            if( $widget = Widgets::find()->where("slug='".Yii::$app->request->post('widget_slug')."'")->one() ){

                $widgetClass = 'common\\components\\widgets\\' . ucfirst($widget->slug);

                $params = $widgetClass::params();

                if( Yii::$app->request->post('widget_id') ){

                    $model = WidgetsInLayouts::find()->where("id=".(int)Yii::$app->request->post('widget_id'))->one();

                    $newrecord = 0;

                } else {

                    $model = new WidgetsInLayouts();

                    $newrecord = 1;

                }



                $attachments = new \common\components\attachments();

                $widget_params = array();

                foreach( $params as $param ){

                    if( $param["type"] == 'file' ){

                        $attached_files = isset( $_FILES[ $param["slug"] ] ) ? $attachments->upload( $_FILES[ $param["slug"] ] , 'widgets' ) : [];

                        $widget_params[ $param["slug"] ] = $attached_files;

                        if( isset($model->params) && ( ( isset($param["multiple"]) && $param["multiple"] == true ) || count($attached_files) == 0 ) ) {

                            $model_params = unserialize( $model->params );

                            if( isset($model_params[$param["slug"]]) && is_array($model_params[$param["slug"]]) ) {

                                $preattached_files = $model_params[$param["slug"]];

                                foreach ($preattached_files as $preatt_file)
                                    $widget_params[$param["slug"]][] = $preatt_file;

                            }

                        }

                    } else {

                        if( $param["type"] == 'group' ){

                            $widget_params[$param["slug"]] = array();

                            foreach( Yii::$app->request->post($param["slug"]) as $child_index=>$child_param ){

                                foreach( $child_param as $ch_ind=>$ch_val ){

                                    if( !isset($widget_params[$param["slug"]][ $ch_ind ]) ) $widget_params[$param["slug"]][ $ch_ind ] = array();

                                    $widget_params[$param["slug"]][ $ch_ind ][ $child_index ] = $ch_val;

                                }

                            }

                        } else {

                            $widget_params[$param["slug"]] = isset($_POST[$param["slug"]]) ? Yii::$app->request->post($param["slug"]) : $param["default"];

                        }

                    }

                }

                $model->edited_layout = true;

                if( $model->isNewRecord ) $model->order = 1;
                $model->layout_id = (int)Yii::$app->request->post('layout_id');
                $model->params = serialize($widget_params);
                $model->widget_id = $widget->id;
                $model->title = Yii::$app->request->post('widget_title');
                $model->position = Yii::$app->request->post('widget_position');
                $model->type = "widget";

                $model->save(false);

                $json["success"] = 1;
                $json["widget"] = [
                    "id" => $model->id,
                    "widget_id" => $model->widget_id,
                    "title" => $model->title,
                    "position" => $model->position,
                    "active" => $model->active,
                    "order" => $model->order,
                    "type" => $model->type,
                    "params" => $widget_params,
                    "newrecord" => $newrecord,
                    "widget_title" => ( $model->type == 'widget' ? $model->widget->title : $model->widgetarea->title ),
                    "widget_description" => ( $model->type == 'widget' ? $model->widget->description : '' )
                ];

            } else
                $json["success"] = 0;

        } else
            $json["success"] = 0;

        return json_encode($json);

    }

    public function actionSavewidgetarea(){

        $json = array();

        if(
            Yii::$app->request->post('widget_area_id') &&
            Yii::$app->request->post('widget_area_position') &&
            Yii::$app->request->post('widget_area_title') &&
            Yii::$app->request->post('layout_id')
        ){

            if( $widget = WidgetsAreas::find()->where("id='".Yii::$app->request->post('widget_area_id')."'")->one() ){

                if( Yii::$app->request->post('layout_area_id') ){

                    $model = WidgetsInLayouts::find()->where("id=".(int)Yii::$app->request->post('layout_area_id'))->one();

                    $newrecord = 0;

                } else {

                    $model = new WidgetsInLayouts();

                    $newrecord = 1;

                }


                $widget_params = array();

                $model->order = 1;
                $model->layout_id = (int)Yii::$app->request->post('layout_id');
                $model->params = serialize($widget_params);
                $model->widget_id = $widget->id;
                $model->title = Yii::$app->request->post('widget_area_title');
                $model->position = Yii::$app->request->post('widget_area_position');
                $model->type = "area";

                $model->save(false);

                $json["success"] = 1;
                $json["widget"] = [
                    "id" => $model->id,
                    "widget_id" => $model->widget_id,
                    "title" => $model->title,
                    "position" => $model->position,
                    "active" => $model->active,
                    "order" => $model->order,
                    "type" => $model->type,
                    "params" => $widget_params,
                    "newrecord" => $newrecord,
                    "widget_title" => ( $model->type == 'widget' ? $model->widget->title : $model->widgetarea->title ),
                    "widget_description" => ( $model->type == 'widget' ? $model->widget->description : '' )
                ];

            } else
                $json["success"] = 0;

        } else
            $json["success"] = 0;

        return json_encode($json);

    }

    public function actionWidgetinfo( $id ){

        $json = array();

        if( $model = WidgetsInLayouts::find()->where("id=".$id)->one() ){

            if( $model->type == 'widget' ) $widget = \backend\models\Widgets::find()->where("id=".$model->widget_id)->one();

            $json = [
                "id" => $model->id,
                "widget_id" => $model->widget_id,
                "widget_slug" => $model->type == 'widget' ? $widget->slug : '',
                "title" => $model->title,
                "position" => $model->position,
                "active" => $model->active,
                "order" => $model->order,
                "type" => "widget",
                "params" => unserialize($model->params),
                "widget_title" => ( $model->type == 'widget' ? $model->widget->title : $model->widgetarea->title ),
                "widget_description" => ( $model->type == 'widget' ? $model->widget->description : '' )
            ];

        }

        echo json_encode( $json );

        exit;

    }

    public function actionDelwidget( $id ){

        $json = array();

        if( $model = WidgetsInLayouts::find()->where("id=".$id)->one() ){

            $model->delete();

            $json["success"] = 1;

        } else
            $json["success"] = 0;

        echo json_encode( $json );

        exit;

    }

    public function actionActivewidget( $id ){

        $json = array();

        if( $model = WidgetsInLayouts::find()->where("id=".$id)->one() ){

            $active = isset($_GET["active"]) ? (int)$_GET["active"] : 0;

            $model->active = $active;

            $model->save(false);

            $json["success"] = 1;

        } else
            $json["success"] = 0;

        echo json_encode( $json );

        exit;

    }

    public function actionActivesection( $id ){

        $json = array();

        $section = isset($_GET["section"]) ? $_GET["section"] : '';
        $active = isset($_GET["active"]) ? (int)$_GET["active"] : 0;

        LayoutsSettings::setActive( $id, $section, $active );

        $json["success"] = 1;

        echo json_encode( $json );

        exit;

    }

    public function actionReorder(){

        $json = array();

        $json["success"] = 0;

        if( isset($_GET["order"]) ){

            $order = explode( ",", $_GET["order"] );

            if( count($order) > 0 ){

                foreach( $order as $ord ){

                    $ord_arr = explode( "_", $ord );

                    if( count($ord_arr) == 3 ) {

                        if ($model = WidgetsInLayouts::find()->where("id=" . (int)$ord_arr[0])->one()) {

                            $model->order = (int)$ord_arr[1];
                            $model->position = $ord_arr[2];

                            $model->save(false);

                        }

                    }

                }

                $json["success"] = 1;

            }

        }



        echo json_encode( $json );

        exit;

    }

}
