<?php

namespace backend\controllers;

use Yii;
use common\models\Pages;
use backend\models\PagesRevisions;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;


/**
 * PagesController implements the CRUD actions for Pages model.
 */
class PagesController extends BaseController
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
     * Lists all Pages models.
     * @return mixed
     */
    public function actionIndex()
    {

        $searchModel = new Pages();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->dynamic_render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'grid_fields' => [
                ['class' => 'yii\grid\SerialColumn'],
                'name',

                ['class' => 'yii\grid\ActionColumn'],
            ]
        ]);
    }

    /**
     * Displays a single Pages model.
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
     * Creates a new Pages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pages();

        if ($model->load(Yii::$app->request->post()) && $model->save() && \common\components\Settings::saveSettingsBlock( $model->id )) {

            $reserv = new \backend\models\PagesRevisions();

            $reserv->page_id = $model->id;
            $reserv->user_id = \Yii::$app->user->identity->id;
            $reserv->content = $model->content;
            $reserv->date = date("Y-m-d H:i:s");
            $reserv->action = 'Created';

            $reserv->save();

            return $this->redirect('update/'.$reserv->page_id);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Pages model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $old_content = $model->content;

        if ($model->load(Yii::$app->request->post()) && $model->save() && \common\components\Settings::saveSettingsBlock( $model->id )) {

            if( $old_content != $model->content ){

                $reserv = new \backend\models\PagesRevisions();

                $reserv->page_id = $model->id;
                $reserv->user_id = \Yii::$app->user->identity->id;
                $reserv->content = $model->content;
                $reserv->date = date("Y-m-d H:i:s");
                $reserv->action = 'Changed';

                $reserv->save();

            }

            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Pages model.
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
     * Finds the Pages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pages::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function beforeAction($action)
    {
        if ($action->id == 'delete') {
            Yii::$app->controller->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }

    public function actionRestore($id){

        if( $revision = PagesRevisions::find()->where("id=".$id)->one() ){

            $page = Pages::find()->where("id=".$revision->page_id)->one();

            $old_content = $page->content;

            $page->content = $revision->content;

            $page->save();

            if( $old_content != $page->content ) {

                $reserv = new \backend\models\PagesRevisions();

                $reserv->page_id = $revision->page_id;
                $reserv->user_id = \Yii::$app->user->identity->id;
                $reserv->content = $page->content;
                $reserv->date = date("Y-m-d H:i:s");
                $reserv->action = 'Restore to '.$revision->date;

                $reserv->save();

            }

        }

        return $this->redirect( $_SERVER["HTTP_REFERER"] );

    }
}
