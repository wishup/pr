<?php

namespace backend\controllers;

use Yii;
use common\models\Faq;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * FaqController implements the CRUD actions for Faq model.
 */
class FaqController extends BaseController
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
     * Lists all Faq models.
     * @return mixed
     */
    public function actionIndex()
    {

        $searchModel = new Faq();

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
                'question:ntext',
                [
                    'attribute' => 'name',
                    'value' => 'faqcategories.name',
                    'label' => 'Category name',
                ],

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);
    }

    /**
     * Displays a single Faq model.
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
     * Creates a new Faq model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Faq();

        if ($model->load(Yii::$app->request->post())) {
            $model->category_id = Yii::$app->request->post('category_id');
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Faq model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->category_id = Yii::$app->request->post('category_id');
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Faq model.
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
     * Finds the Faq model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Faq the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Faq::findOne($id)) !== null) {
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
