<?php

namespace backend\controllers;

use common\models\MailingUsers;
use Yii;
use common\models\Mailing;
use common\models\Users;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MailingController implements the CRUD actions for Mailing model.
 */
class MailingController extends BaseController
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
     * Lists all Mailing models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Mailing::find(),
        ]);

        return $this->dynamic_render('index', [
            'dataProvider' => $dataProvider,
            'grid_fields' => [
                ['class' => 'yii\grid\SerialColumn'],

                //'id',
                'title',
                //'from_name',
                //'from_email:email',
                'subject',
                // 'message:ntext',
                'start_at',
                // 'last_at',
                // 'frequency',
                // 'email_count:email',
                // 'final_notification',
                // 'paused',
                'finished',
                'created_at',

                ['class' => 'yii\grid\ActionColumn'],
            ]
        ]);
    }

    /**
     * Displays a single Mailing model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionPreview($id)
    {

        $mailinguser = MailingUsers::find()->where('mailing_id = '.$id)->orderBy("rand()")->one();

        $this->layout = 'email';

        return $this->render('preview', [
            'model' => $this->findModel($id),
            "user" => $mailinguser->user,
        ]);
    }

    /**
     * Creates a new Mailing model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Mailing();

        $model->paused = 1;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id, 'step' => '2']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'step' => 1,
            ]);
        }
    }

    /**
     * Updates an existing Mailing model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id, $step = 1)
    {
        $model = $this->findModel($id);

        $usersdataProvider = new ActiveDataProvider([
            'query' => Users::find(),
            'sort' => ['attributes' => ['']]
        ]);

        $usersdataProvider->pagination->pageSize=-1;

        if ($model->load(Yii::$app->request->post()) && $model->paused == 1 && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id, 'step' => '2']);
        }

        if( Yii::$app->request->post("userslist")  && $model->paused == 1 ){

            MailingUsers::deleteAll('mailing_id = '.$id);

            foreach( Yii::$app->request->post("userslist") as $usercheck=>$usercheck_id ){

                $mailing_user = new MailingUsers();

                $mailing_user->mailing_id = $id;
                $mailing_user->user_id = $usercheck_id;
                $mailing_user->sent = 0;

                $mailing_user->save( false );

            }

            return $this->redirect(['update', 'id' => $model->id, 'step' => '3']);

        }

        if( Yii::$app->request->post("send_email")  && $model->paused == 1 ){

            $model->paused = 0;

            $model->save( false );

            return $this->redirect(['index']);

        }

        if( Yii::$app->request->post("submit_preview") ){

            return $this->redirect(['update', 'id' => $model->id, 'step' => '4']);

        }

        $mailingusers = MailingUsers::find()->where('mailing_id = '.$id)->indexBy("user_id")->all();
        $mailinguserssent = MailingUsers::find()->where('mailing_id = '.$id." AND sent=1")->indexBy("user_id")->all();

        return $this->render('update', [
            'model' => $model,
            "usersdataProvider" => $usersdataProvider,
            'step' => $step,
            'mailingusers' => $mailingusers,
            'mailinguserssent' => $mailinguserssent,
        ]);
    }

    /**
     * Deletes an existing Mailing model.
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
     * Finds the Mailing model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Mailing the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Mailing::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
