<?php

namespace backend\controllers;

use common\models\UnsubscribeReasons;
use Yii;
use common\models\Unsubscribe;
use common\models\UnsubscribeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UnsubscribeController implements the CRUD actions for Unsubscribe model.
 */
class UnsubscribeController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Unsubscribe models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UnsubscribeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->dynamic_render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'grid_fields' => [

                        'id',
            'email:email',
            'group_id' => [
                "attribute" => "group_id",
                "label" => "Group",
                "value" => function($model){

                    $groupmodels = \common\models\EmailGroups::find()->orderBy("title")->all();
                    $group_items = [0=>''];
                    foreach( $groupmodels as $groupmodel )
                        $group_items[ $groupmodel->id ] = $groupmodel->title;

                    return $group_items[ $model->group_id ];

                }
            ],

                'reason_id' => [
                    "attribute" => "reason_id",
                    "label" => "Reason",
                    "value" => function($model){

                        if( $model->reason_id ) {
                            $reasonmodel = UnsubscribeReasons::find()->where("id=" . $model->reason_id)->one();

                            return $reasonmodel ? $reasonmodel->reason : '';
                        } else {
                            return '';
                        }

                    }
                ],

            ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);
    }

    /**
     * Displays a single Unsubscribe model.
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
     * Creates a new Unsubscribe model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Unsubscribe();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Unsubscribe model.
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
     * Deletes an existing Unsubscribe model.
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
     * Finds the Unsubscribe model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Unsubscribe the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Unsubscribe::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
