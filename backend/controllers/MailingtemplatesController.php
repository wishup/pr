<?php

namespace backend\controllers;

use Yii;
use backend\models\MailingTemplates;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MailingtemplatesController implements the CRUD actions for MailingTemplates model.
 */
class MailingtemplatesController extends BaseController
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
     * Lists all MailingTemplates models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => MailingTemplates::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MailingTemplates model.
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
     * Creates a new MailingTemplates model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MailingTemplates();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing MailingTemplates model.
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
     * Deletes an existing MailingTemplates model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionGettemplate($id)
    {
        $model = $this->findModel($id);

        echo json_encode(["message" => $model->message]);

        exit;
    }

    /**
     * Finds the MailingTemplates model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MailingTemplates the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MailingTemplates::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionSendtest( $id ){

        if( Yii::$app->request->post("email") ){

            $model = MailingTemplates::find()->where("id=".$id)->one();

            $content = \common\components\Email::renderFromText($model->message, 1);

            \common\components\Email::send( Yii::$app->params["project_name"], Yii::$app->params["adminEmail"], "", Yii::$app->request->post("email"), $model->title, $content );

            \Yii::$app->getSession()->setFlash('success', 'Email was sent to '.Yii::$app->request->post("email"));

        } else {

            \Yii::$app->getSession()->setFlash('error', "Please fill correct email address");

        }

        return $this->redirect( $_SERVER["HTTP_REFERER"] );

    }

    public function actionPreview(){

        return $this->renderPartial('preview');

    }
}
