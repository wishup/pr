<?php

namespace backend\controllers;

use Yii;
use common\models\Glossary;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * GlossaryController implements the CRUD actions for Glossary model.
 */
class GlossaryController extends BaseController
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
     * Lists all Glossary models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new Glossary();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->dynamic_render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'grid_fields' => [
                ['class' => 'yii\grid\SerialColumn'],
                'status'=>[
                    "label" => "Status",
                    "value" => function($model){

                        switch( $model->status ){

                            case 'draft': $status_name = 'Draft'; break;
                            case 'published': $status_name = 'Published'; break;
                            case 'archived': $status_name = 'Archived'; break;
                            default: $status_name = ''; break;

                        }

                        return $status_name;
                    },
                    'filter' => ['draft' => 'Draft', 'published' => 'Published', 'archived' => 'Archived'],
                    'attribute' => 'status',
                ],
                'word',
                'description:ntext',

                ['class' => 'yii\grid\ActionColumn'],
            ]
        ]);
    }

    /**
     * Displays a single Glossary model.
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
     * Creates a new Glossary model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Glossary();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Glossary model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Glossary model.
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
     * Finds the Glossary model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Glossary the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Glossary::findOne($id)) !== null) {
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
}
