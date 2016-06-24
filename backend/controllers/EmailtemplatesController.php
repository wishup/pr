<?php

namespace backend\controllers;

use Yii;
use common\models\Emailtemplates;
use common\models\Emaillayouts;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\EmailtemplatesRevisions;

/**
 * EmailtemplatesController implements the CRUD actions for Emailtemplates model.
 */
class EmailtemplatesController extends BaseController
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
     * Lists all Emailtemplates models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new Emailtemplates();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->dynamic_render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'grid_fields' => [
                ['class' => 'yii\grid\SerialColumn'],

                'title',
                'subject',
                'from_name',
                'from_email:email',
                'status'=> [
                    'attribute' => 'status',
                    'label' => 'Status',
                    'value'=>function($model){
                        return ($model->status)?"Enabled":"Disabled";
                    },
                    'filter' => array_filter(array('1' => 'Enabled', '0' => 'Disabled'))
                ],
                'is_used' => [
                    'attribute' => 'slug',
                    'label' => 'In use',
                    'value' => function($model){
                        return ($model->slug)? 'Yes':'No';
                    },
                    'filter' => array_filter(array('1' => 'Yes', '0' => 'No'))
                ],
                [
                    "label" => "",
                    "value" => function($model){
                        if( !$model->slug ){
                            return '<a href="/backend/emailtemplates/delete/'.$model->id.'" class="btn btn-danger btn-xs" data-method="post" data-confirm="Are you sure you want to delete this item?" data-pjax="0">Delete</a>';
                        } else
                            return '';
                    },
                    "format" => "raw"
                ],
                // 'shortcodes:ntext',

                ['class' => 'yii\grid\ActionColumn', 'buttons'=>[
                    'delete' => function ($url, $model, $key) {
                        return false;
                    },
                ]],
            ]
        ]);
    }

    /**
     * Displays a single Emailtemplates model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model
        ]);
    }

    /**
     * Displays email preview file.
     * @return mixed
     */
    public function actionPreview($id)
    {
        $this->layout = 'email';
        return $this->render('preview', ["id"=>$id]);
    }

    /**
     * Creates a new Emailtemplates model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Emailtemplates();
        $leyouts = Emaillayouts::find()->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $reserv = new \backend\models\EmailtemplatesRevisions();

            $reserv->emailtemplate_id = $model->id;
            $reserv->user_id = \Yii::$app->user->identity->id;
            $reserv->content = $model->content;
            $reserv->plaintext = $model->plaintext;
            $reserv->date = date("Y-m-d H:i:s");
            $reserv->action = 'Created';

            $reserv->save();

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'leyouts' => $leyouts,
            ]);
        }
    }

    /**
     * Updates an existing Emailtemplates model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $leyouts = Emaillayouts::find()->all();

        $old_content = $model->content;
        $old_plaintext = $model->plaintext;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            if( $old_content != $model->content || $old_plaintext != $model->plaintext ){

                $reserv = new \backend\models\EmailtemplatesRevisions();

                $reserv->emailtemplate_id = $model->id;
                $reserv->user_id = \Yii::$app->user->identity->id;
                $reserv->content = $model->content;
                $reserv->plaintext = $model->plaintext;
                $reserv->date = date("Y-m-d H:i:s");
                $reserv->action = 'Changed';

                $reserv->save();

            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'leyouts' => $leyouts,
            ]);
        }
    }

    /**
     * Deletes an existing Emailtemplates model.
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
     * Finds the Emailtemplates model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Emailtemplates the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Emailtemplates::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionRestore($id){

        if( $revision = EmailtemplatesRevisions::find()->where("id=".$id)->one() ){

            $emailtemplate = Emailtemplates::find()->where("id=".$revision->emailtemplate_id)->one();

            $old_content = $emailtemplate->content;
            $old_plaintext = $emailtemplate->plaintext;

            $emailtemplate->content = $revision->content;
            $emailtemplate->plaintext = $revision->plaintext;

            $emailtemplate->save();

            if( $old_content != $emailtemplate->content || $old_plaintext != $emailtemplate->plaintext ) {

                $reserv = new \backend\models\EmailtemplatesRevisions();

                $reserv->emailtemplate_id = $revision->emailtemplate_id;
                $reserv->user_id = \Yii::$app->user->identity->id;
                $reserv->content = $emailtemplate->content;
                $reserv->plaintext = $emailtemplate->plaintext;
                $reserv->date = date("Y-m-d H:i:s");
                $reserv->action = 'Restore to '.$revision->date;

                $reserv->save();

            }

        }

        return $this->redirect( $_SERVER["HTTP_REFERER"] );

    }
}
