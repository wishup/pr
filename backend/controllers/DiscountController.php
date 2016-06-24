<?php

namespace backend\controllers;

use common\models\Seasons;
use common\models\Users;
use common\models\UsersFamilies;
use common\models\UsersHosts;
use Yii;
use common\models\Discount;
use common\models\DiscountSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DiscountController implements the CRUD actions for Discount model.
 */
class DiscountController extends BaseController
{
    public $grid_disable_bulk_actions = true;
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
     * Lists all Discount models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DiscountSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->dynamic_render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'grid_fields' => [
                ['class' => 'yii\grid\SerialColumn'],

                //'id',
                'title',
                'code',
                'discount_type' =>[
                    'attribute' => 'discount_type',
                    'label' => 'Type',
                    'value' => function($model){
                        $filters = [''=>'', 'fixed'=>'Fixed', 'percent'=>'Percent'];
                        return $filters[$model->discount_type];
                    },
                    'filter' => array_filter(['fixed'=>'Fixed', 'percent'=>'Percent'])
                ],
                'per_type' =>[
                    'attribute' => 'per_type',
                    'label' => 'Per Type',
                    'value' => function($model){
                        $filters = Yii::$app->params['discount_per_types'];
                        return $filters[$model->per_type];
                    },
                    'filter' => array_filter(Yii::$app->params['discount_per_types'])
                ],
                'amount',
                'limit',
                'usage',

                ['class' => 'yii\grid\ActionColumn'],
            ]
        ]);
    }

    /**
     * Displays a single Discount model.
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
     * Creates a new Discount model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Discount();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Discount model.
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
     * Deletes an existing Discount model.
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
     * Finds the Discount model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Discount the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Discount::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionGetmodel(){

        if( Yii::$app->request->get("model") ){

            $result = [];

            switch( Yii::$app->request->get("model") ){

                case 'users':

                    $users = Users::find()->all();

                    foreach( $users as $user ){

                        $result[] = [
                            "option" => $user->userInfos->first_name.' '.$user->userInfos->last_name,
                            "value" => $user->id,
                        ];

                    }

                    break;

                case 'users_hosts':

                    $season = Seasons::getCurrent();

                    $hosts = UsersHosts::find()->all();

                    foreach( $hosts as $host ){

                        if( $season->id != $host->user->season_id ) continue;

                        $result[] = [
                            "option" => $host->user->user->userInfos->first_name.' '.$host->user->user->userInfos->last_name,
                            "value" => $host->id,
                        ];

                    }

                    break;

                case 'users_families':

                    $season = Seasons::getCurrent();

                    $families = UsersFamilies::find()->all();

                    foreach( $families as $family ){

                        if( $season->id != $family->user->season_id ) continue;

                        $result[] = [
                            "option" => $family->user->user->userInfos->first_name.' '.$family->user->user->userInfos->last_name,
                            "value" => $family->id,
                        ];

                    }

                    break;

            }

            return json_encode( $result );

        }

    }
}
