<?php

namespace backend\controllers;

use Yii;
use common\models\ResourcesCategories;
use common\models\ResourcesCategoriesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ResourcesCategoriesController implements the CRUD actions for ResourcesCategories model.
 */
class ResourcesCategoriesController extends BaseController
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
     * Lists all ResourcesCategories models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ResourcesCategoriesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->dynamic_render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'grid_fields' => [

                        'id',
            'title',
            'subtitle',

            ['class' => 'yii\grid\ActionColumn', 'template' => "{update} {delete}"],
            ],
        ]);
    }

    public function actionDelthumb($id){

        if( Yii::$app->request->post() ){

            $model = $this->findModel($id);

            $model->image = '';

            $model->save( false );

            return $this->redirect($_SERVER["HTTP_REFERER"]);

        }

    }

    /**
     * Displays a single ResourcesCategories model.
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
     * Creates a new ResourcesCategories model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ResourcesCategories();

        if ($model->load(Yii::$app->request->post()) && $model->image =UploadedFile::getInstance($model,'image')) {

            $model->image->saveAs(Yii::getAlias('@frontend').'/web/upload/resources/' . $model->image->baseName . '.' . $model->image->extension);

            $model->save();

            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ResourcesCategories model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $sl = $model->image;

        if ($model->load(Yii::$app->request->post())) {

            if( $img = UploadedFile::getInstance($model, 'image') ) {
                $model->image = $img;
                $model->image->saveAs(Yii::getAlias('@frontend').'/web/upload/resources/' . $model->image->baseName . '.' . $model->image->extension);
            }else{
                $model->image = $sl;
            }


            $model->save( false );

            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ResourcesCategories model.
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
     * Finds the ResourcesCategories model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ResourcesCategories the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ResourcesCategories::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


}
