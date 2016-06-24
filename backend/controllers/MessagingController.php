<?php

namespace backend\controllers;

use Yii;
use common\models\Messaging;
use common\models\MessagingUsers;
use backend\models\MessagingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Users;
use yii\data\ActiveDataProvider;

/**
 * MessagingController implements the CRUD actions for Messaging model.
 */
class MessagingController extends BaseController
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
     * Lists all Messaging models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MessagingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->dynamic_render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'grid_fields' => [
                ['class' => 'yii\grid\SerialColumn'],

                //'id',
                'title',
                'message:html',
                'start_at',
                'finish_at',
                // 'can_close',

                ['class' => 'yii\grid\ActionColumn'],
            ]
        ]);
    }

    /**
     * Displays a single Messaging model.
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
     * Creates a new Messaging model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Messaging();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            if( Yii::$app->request->post("userslist") ){

                foreach( Yii::$app->request->post("userslist") as $usercheck=>$usercheck_id ){

                    $msg_user = new MessagingUsers();

                    $msg_user->message_id = $model->id;
                    $msg_user->user_id = $usercheck_id;
                    $msg_user->closed = 0;

                    $msg_user->save( false );

                }

                return $this->redirect(['update', 'id' => $model->id]);

            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {

            $usersdataProvider = new ActiveDataProvider([
                'query' => Users::find(),
                'sort' => ['attributes' => ['']]
            ]);

            $usersdataProvider->pagination->pageSize=-1;

            return $this->render('create', [
                'model' => $model,
                'usersdataProvider' => $usersdataProvider,
                'mailingusers' => [],
            ]);
        }
    }

    /**
     * Updates an existing Messaging model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $messagingusers = MessagingUsers::find()->where('message_id = '.$id)->indexBy("user_id")->all();

            if( Yii::$app->request->post("userslist") ){

                foreach( Yii::$app->request->post("userslist") as $usercheck=>$usercheck_id ){

                    if( isset( $messagingusers[ $usercheck_id ] ) ) continue;

                    $msg_user = new MessagingUsers();

                    $msg_user->message_id = $model->id;
                    $msg_user->user_id = $usercheck_id;
                    $msg_user->closed = 0;

                    $msg_user->save( false );

                }



            }

            if( Yii::$app->request->post("userslistdel") ){

                foreach( Yii::$app->request->post("userslistdel") as $usercheck=>$usercheck_id ){

                    $messagingusers[ $usercheck_id ]->delete();

                }



            }

            return $this->redirect(['update', 'id' => $id]);
        } else {

            $usersdataProvider = new ActiveDataProvider([
                'query' => Users::find(),
                'sort' => ['attributes' => ['']]
            ]);

            $usersdataProvider->pagination->pageSize=-1;

            $messagingusers = MessagingUsers::find()->where('message_id = '.$id)->indexBy("user_id")->all();

            return $this->render('update', [
                'model' => $model,
                'usersdataProvider' => $usersdataProvider,
                'mailingusers' => $messagingusers,
            ]);
        }
    }

    /**
     * Deletes an existing Messaging model.
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
     * Finds the Messaging model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Messaging the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Messaging::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
