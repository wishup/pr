<?php

namespace backend\controllers;

use Yii;
use common\models\Slides;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * SlidesController implements the CRUD actions for Slides model.
 */
class SlidesController extends BaseController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Slides models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Slides::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Slides model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Slides model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new Slides();

        if ($model->load(Yii::$app->request->post()) && $model->slide =UploadedFile::getInstance($model,'slide')) {

            $model->slide->saveAs(Yii::getAlias('@frontend').'/web/upload/' . $model->slide->baseName . '.' . $model->slide->extension);
            $model->order = 999;
            $model->slider_id = $id;
            $model->save();

            return $this->redirect(['sliders/view', 'id' => $model->slider_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Slides model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $sl = $model->slide;

        if ($model->load(Yii::$app->request->post())) {

            if( $slide = UploadedFile::getInstance($model, 'slide') ) {
                $model->slide = $slide;
                $model->slide->saveAs(Yii::getAlias('@frontend').'/web/upload/' . $model->slide->baseName . '.' . $model->slide->extension);
            }else{
                $model->slide = $sl;
            }

            $model->save();

            return $this->redirect(['sliders/view', 'id' => $model->slider_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Slides model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $this->findModel($id)->delete();

        return $this->redirect(['sliders/view', 'id' => $model->slider_id]);
    }

    /**
     * saves the reordered rows.
     */
    public function actionReorder()
    {
        $post_indexes = Yii::$app->request->post();
        if(isset($post_indexes['indexes'])){
            foreach($post_indexes['indexes'] as $id => $order){
                $model = $this->findModel($id);
                $model->order = $order;
                $model->save();
            }
        }
    }

    /**
     * Finds the Slides model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Slides the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Slides::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function beforeAction($action)
    {
        if ($action->id == 'reorder') {
            Yii::$app->controller->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }
}
