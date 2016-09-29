<?php

namespace backend\controllers;

use common\models\ShopProdCat;
use Yii;
use common\models\ShopProducts;
use common\models\ShopProductsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ShopproductsController implements the CRUD actions for ShopProducts model.
 */
class ShopproductsController extends BaseController
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
     * Lists all ShopProducts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ShopProductsSearch();
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
                'price',


            ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);
    }

    /**
     * Displays a single ShopProducts model.
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
     * Creates a new ShopProducts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ShopProducts();

        if ($model->load(Yii::$app->request->post())) {

            if( $model->image =UploadedFile::getInstance($model,'image') ) {

                $filename = md5(rand(0,1000000).time()).$model->image->baseName . '.' . $model->image->extension;

                $model->image->saveAs(Yii::getAlias('@frontend') . '/web/upload/' . $filename);

                $model->image = $filename;
            }

            if( $model->save() ){

                if(Yii::$app->request->post("categories"))
                    foreach( Yii::$app->request->post("categories") as $category_id ){

                        if( !$prodcat = ShopProdCat::find()->where("product_id=".$model->id." and category_id=".(int)$category_id)->one() ) {
                            $prodcat = new ShopProdCat();
                            $prodcat->product_id = $model->id;
                            $prodcat->category_id = (int)$category_id;
                            $prodcat->save();
                        }

                    }

                if( Yii::$app->request->post("attributes") ){
                    foreach( Yii::$app->request->post("attributes") as $attribute_id => $attribute_val ){

                        if( $attribute_val != '' ){

                            if( !$prodattr = \common\models\ShopProductsAttrVals::find()->where("product_id=".$model->id." and attribute_id=".$attribute_id)->one() )
                                $prodattr = new \common\models\ShopProductsAttrVals();

                            $prodattr->product_id = $model->id;
                            $prodattr->attribute_id = (int)$attribute_id;
                            $prodattr->value = $attribute_val;

                            $prodattr->save();

                        } else {

                            \common\models\ShopProductsAttrVals::deleteAll("product_id=".$model->id." and attribute_id=".$attribute_id);

                        }

                    }
                }

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
     * Updates an existing ShopProducts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $old_image = $model->image;

        if ($model->load(Yii::$app->request->post()) ) {

            if( $model->image =UploadedFile::getInstance($model,'image') ) {

                $filename = md5(rand(0,1000000).time()).$model->image->baseName . '.' . $model->image->extension;

                $model->image->saveAs(Yii::getAlias('@frontend') . '/web/upload/' . $filename);

                $model->image = $filename;
            } else {
                $model->image = $old_image;
            }

            if( $model->save() ){

                ShopProdCat::deleteAll("product_id=".$model->id.( Yii::$app->request->post("categories") ? " AND `category_id` NOT IN (".implode(",", Yii::$app->request->post("categories")).")" : "" ));

                if(Yii::$app->request->post("categories"))
                    foreach( Yii::$app->request->post("categories") as $category_id ){

                        if( !$prodcat = ShopProdCat::find()->where("product_id=".$model->id." and category_id=".(int)$category_id)->one() ) {
                            $prodcat = new ShopProdCat();
                            $prodcat->product_id = $model->id;
                            $prodcat->category_id = (int)$category_id;
                            $prodcat->save();
                        }

                    }

                if( Yii::$app->request->post("attributes") ){
                    foreach( Yii::$app->request->post("attributes") as $attribute_id => $attribute_val ){

                        if( $attribute_val != '' ){

                            if( !$prodattr = \common\models\ShopProductsAttrVals::find()->where("product_id=".$model->id." and attribute_id=".$attribute_id)->one() )
                                $prodattr = new \common\models\ShopProductsAttrVals();

                            $prodattr->product_id = $model->id;
                            $prodattr->attribute_id = (int)$attribute_id;
                            $prodattr->value = $attribute_val;

                            $prodattr->save();

                        } else {

                            \common\models\ShopProductsAttrVals::deleteAll("product_id=".$model->id." and attribute_id=".$attribute_id);

                        }

                    }
                }

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
     * Deletes an existing ShopProducts model.
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
     * Finds the ShopProducts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ShopProducts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ShopProducts::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
