<?php

namespace backend\controllers;

use Yii;
use common\models\ShopCategories;
use common\models\ShopCategoriesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ShopcategoriesController implements the CRUD actions for ShopCategories model.
 */
class ShopcategoriesController extends BaseController
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

    public function actionDelimg($id){

        $model = $this->findModel($id);

        $model->image = '';

        $model->save();

        return $this->redirect( $_SERVER["HTTP_REFERER"] );

    }

    /**
     * Lists all ShopCategories models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ShopCategoriesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $catitems = [];

        if( $catmodels = ShopCategories::find()->orderBy("name")->all() ){

            foreach( $catmodels as $catmodel ){
                $catitems[$catmodel->id] = $catmodel->name;
            }

        }

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
            'parent_id' => [
                "attribute" => "parent_id",
                "label" => "Parent category",
                "value" => function($model) use ($catitems){

                    return isset( $catitems[ $model->parent_id ] ) ? $catitems[ $model->parent_id ] : '';

                },
                "filter" => $catitems
            ],
            'name',


            ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);
    }

    /**
     * Displays a single ShopCategories model.
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
     * Creates a new ShopCategories model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ShopCategories();

        if ($model->load(Yii::$app->request->post())) {

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
     * Updates an existing ShopCategories model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {

            $old_image = $model->image;

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
     * Deletes an existing ShopCategories model.
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
     * Finds the ShopCategories model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ShopCategories the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ShopCategories::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
