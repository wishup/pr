<?php

namespace backend\controllers;

use backend\models\WidgetsInAreas;
use common\models\WidgetsInLayouts;
use Yii;
use backend\models\Widgets;
use backend\models\WidgetsAreas;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * WidgetController implements the CRUD actions for Widgets model.
 */
class WidgetController extends BaseController
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
     * Lists all Widgets models.
     * @return mixed
     */
    public function actionIndex()
    {

        $widgets = Widgets::find()->orderBy('title')->all();
        $areas = WidgetsAreas::find()->orderBy('title')->all();

        return $this->render('index', [
            'widgets' => $widgets,
            'areas' => $areas,
        ]);
    }

    /**
     * Finds the Widgets model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Widgets the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Widgets::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionSave(){

        $json = array();

        if(
            Yii::$app->request->post('widget_slug') &&
            Yii::$app->request->post('area')
        ){

            if( $widget = Widgets::find()->where("slug='".Yii::$app->request->post('widget_slug')."'")->one() ){

                $widgetClass = 'common\\components\\widgets\\' . ucfirst($widget->slug);

                $params = $widgetClass::params();

                if( Yii::$app->request->post("widget_in_area") ){

                    $model = WidgetsInAreas::find()->where("id=".Yii::$app->request->post("widget_in_area"))->one();

                } else {

                    $model = new WidgetsInAreas();

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

                        $widget_params[ $param["slug"] ] = isset($_POST[ $param["slug"] ]) ? Yii::$app->request->post($param["slug"]) : $param["default"];

                    }

                }

                $model->order = Yii::$app->request->post("order") ? Yii::$app->request->post("order") : 1;
                $model->area_id = Yii::$app->request->post('area');
                $model->params = serialize($widget_params);
                $model->widget_id = $widget->id;

                $model->save();

                $json["success"] = 1;
                $json["widget"] = [
                    "title" => $widget->title,
                    "description" => $widget->description,
                    "widget_slug" => $widget->slug,
                    "order" => $model->order,
                    "params" => $widget_params,
                    "area" => $model->area_id,
                    "widget_id" => $model->widget_id,
                    "widget_in_area" => $model->id,
                ];

            } else
                $json["success"] = 0;

        } else
            $json["success"] = 0;

        return json_encode($json);

    }

    public function actionDelete(){

        if(
            Yii::$app->request->post('widget_in_area')
        ){

            if( $model = WidgetsInAreas::find()->where("id=".Yii::$app->request->post("widget_in_area"))->one() ){

                $model->delete();

                return 1;

            } else
                return 0;

        } else
            return 0;

    }

    public function actionDeleteattachment(){

        if(
            Yii::$app->request->post('widget_in_area') &&
            Yii::$app->request->post('param_slug') &&
            ( (int)Yii::$app->request->post('file_index')>=0 )
        ){

            if( $model = WidgetsInLayouts::find()->where("id=".Yii::$app->request->post("widget_in_area"))->one() ){

                $params = unserialize($model->params);

                if( isset( $params[ Yii::$app->request->post('param_slug') ][ Yii::$app->request->post('file_index') ] ) ){

                    unset( $params[ Yii::$app->request->post('param_slug') ][ Yii::$app->request->post('file_index') ] );

                    $model->params = serialize( $params );

                    $model->save();

                    return 1;

                } else
                    return 0;

            } else
                return 0;

        } else
            return 0;

    }

    public function beforeAction($action)
    {
        if ($action->id == 'save' || $action->id == 'delete' || $action->id == 'deleteattachment') {
            Yii::$app->controller->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }


}
