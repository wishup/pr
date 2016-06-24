<?php

namespace backend\controllers;

use Yii;
use common\models\Sliders;
use common\models\Slides;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;

/**
 * SlidersController implements the CRUD actions for sliders model.
 */
class SlidersController extends BaseController
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
     * Lists all sliders models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Sliders::find(),
        ]);

        return $this->dynamic_render('index', [
            'dataProvider' => $dataProvider,
            'grid_fields' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'name',

                ['class' => 'yii\grid\ActionColumn'],
            ]
        ]);
    }

    /**
     * Displays a single sliders model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Slides::find()->where("slider_id = {$id}")->orderBy('order'),
        ]);

        return $this->render('view', [
            'dataProvider' => $dataProvider,
            'id' => $id,
            'grid_fields' => [
                'order',
                'slide',
                ['class' => 'yii\grid\ActionColumn', 'buttons'=>[
                    'view' => function ($url, $model, $key) {
                        return false;
                    },
                    'update' => function ($url, $model, $id) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['slides/update/', 'id' => $id], ['title' => 'Update', 'aria-label' => 'Update', 'data-pjax' => '0']);
                    },
                    'delete' => function ($url, $model, $id) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['slides/delete/', 'id' => $id], ['title' => 'Delete', 'aria-label' => 'Delete', 'data-confirm' => 'Are you sure you want to delete this item?', 'data-method' => 'post', 'data-pjax' => '0']);
                    },
                ]],
            ]
        ]);
    }

    /**
     * Creates a new sliders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Sliders();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing sliders model.
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
     * Deletes an existing sliders model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['view', 'id' => $id]);
    }

    /**
     * Finds the sliders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return sliders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sliders::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
