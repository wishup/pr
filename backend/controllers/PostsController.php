<?php

namespace backend\controllers;

use Yii;
use common\models\Posts;
use common\models\PostsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * PostsController implements the CRUD actions for Posts model.
 */
class PostsController extends BaseController
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
     * Lists all Posts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->dynamic_render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'grid_fields' => [
                'image' => [
                    "attribute" => "image",
                    "label" => "Image",
                    "value" => function($model){

                        return $model->image ? '<img src="'.\common\components\attachments::getThumbnailUrl( '/upload/'.$model->image, 100, 100, 'AUTO' ).'">' : '';

                    },
                    "format" => "raw",
                ],
            'name',
            'short_content:ntext',
            'date',
            // 'image',

            ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);
    }

    /**
     * Displays a single Posts model.
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
     * Creates a new Posts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Posts();

        if ($model->load(Yii::$app->request->post()) ) {

            if( $model->image =UploadedFile::getInstance($model,'image') ) {

                $filename = md5(rand(0,1000000).time()).$model->image->baseName . '.' . $model->image->extension;

                $model->image->saveAs(Yii::getAlias('@frontend') . '/web/upload/' . $filename);

                $model->image = $filename;
            }

            if( $model->save() ){

                return $this->redirect(['view', 'id' => $model->id]);

            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }


        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Posts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $old_image = $model->image;

        if ($model->load(Yii::$app->request->post())) {



            if( $model->image =UploadedFile::getInstance($model,'image') ) {

                $filename = md5(rand(0,1000000).time()).$model->image->baseName . '.' . $model->image->extension;

                $model->image->saveAs(Yii::getAlias('@frontend') . '/web/upload/' . $filename);

                $model->image = $filename;
            } else {
                $model->image = $old_image;
            }

            if( $model->save() ){

                return $this->redirect(['view', 'id' => $model->id]);

            } else {

                return $this->render('update', [
                    'model' => $model,
                ]);

            }

        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Posts model.
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
     * Finds the Posts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Posts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Posts::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
