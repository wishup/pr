<?php

namespace backend\controllers;

use common\models\ResourcesCategories;
use Yii;
use common\models\Resources;
use common\models\ResourcesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ResourcesController implements the CRUD actions for Resources model.
 */
class ResourcesController extends BaseController
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
     * Lists all Resources models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ResourcesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $categories_items = [];

        $categories = ResourcesCategories::find()->orderBy('title, subtitle')->all();

        foreach( $categories as $cat ){

            $categories_items[ $cat->id ] = $cat->title.( $cat->subtitle ? ' - '.$cat->subtitle : '' );

        }

        $versionsitems = Yii::$app->params["versions2"];
        $versionsitems[0] = 'All';

        return $this->dynamic_render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'grid_fields' => [

                        'id',
            "category_id" => [
                "attribute" => "category_id",
                "label" => "Category",
                "value" => function($model){
                    return $model->category->title.( $model->category->subtitle ? ' - '.$model->category->subtitle : '' );
                },
                "filter" => $categories_items
            ],
            "age_group" => [
                "attribute" => 'age_group',
                "label" => "Age group",
                "value" => function($model){
                    return $model->age_group ? $model->age_group : 'All';
                },
                "filter" => ["Beginner" => "Beginner", "Primary" => "Primary", "Junior" => "Junior", "Senior" => "Senior", "all" => "All"]
            ],
                "version" => [
                    "attribute" => 'version',
                    "label" => "Version",
                    "value" => function($model){
                        return isset(Yii::$app->params["versions2"][ $model->version ]) ? Yii::$app->params["versions2"][ $model->version ] : 'All';
                    },
                    "filter" => $versionsitems
                ],
            'overlay_text',
            // 'thumbnail',
                "file" => [
                    "attribute" => 'file',
                    "label" => "File",
                    "value" => function($model){
                        return '<a href="/upload/resources/'.$model->file.'">'.$model->file.'</a>';
                    },
                    "format" => "raw"
                ],

            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}',],
            ],
        ]);
    }

    /**
     * Displays a single Resources model.
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
     * Creates a new Resources model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Resources();


        if ($model->load(Yii::$app->request->post())) {

            $model->button_type = Yii::$app->request->post("button_type") ? 'file' : 'link';

            if( $exist = Resources::find()->where("category_id=".$model->category_id." AND `age_group`='".$model->age_group."' AND `version`='".$model->version."'")->one() ){

                \Yii::$app->getSession()->setFlash('error', 'Resource for this category, age group, version combination already exist. <a href="/backend/resources/update/'.$exist->id.'">Edit resource</a>');

                return $this->render('update', [
                    'model' => $model,
                ]);

            }

            if( $thumb = UploadedFile::getInstance($model, 'thumbnail') ) {
                $model->thumbnail = $thumb;
                $uploadedthumb = 1;
            }

            if( $file = UploadedFile::getInstance($model, 'file') ) {
                $model->file = $file;
                $uploadedfile = 1;
            }

            if( isset($uploadedthumb) ){


                $thumbnail_validate = $model->uploadThumb();

            } else {
                $thumbnail_validate = true;
            }

            if( isset($uploadedfile) ){


                $file_validate = $model->uploadFile();

            } else {
                $file_validate = true;
            }

            if( $model->validate() && $thumbnail_validate && $file_validate ){

                $model->save(false);

                return $this->redirect(['update', 'id' => $model->id]);

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
     * Updates an existing Resources model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $old_thumb = $model->thumbnail;
        $old_file = $model->file;

        if ($model->load(Yii::$app->request->post())) {

            $model->button_type = Yii::$app->request->post("button_type") ? 'file' : 'link';

            if( $exist = Resources::find()->where("category_id=".$model->category_id." AND `age_group`='".$model->age_group."' AND `version`='".$model->version."' AND `id`!=".$model->id)->one() ){

                \Yii::$app->getSession()->setFlash('error', 'Resource for this category, age group, version combination already exist. <a href="/backend/resources/update/'.$exist->id.'">Edit resource</a>');

                return $this->render('update', [
                    'model' => $model,
                ]);

            }


            if( $thumb = UploadedFile::getInstance($model, 'thumbnail') ) {
                $model->thumbnail = $thumb;
                $uploadedthumb = 1;
            } else {
                $model->thumbnail = $old_thumb;
            }

            if( $file = UploadedFile::getInstance($model, 'file') ) {
                $model->file = $file;
                $uploadedfile = 1;
            } else {
                $model->file = $old_file;
            }

            if( isset($uploadedthumb) ){


                $thumbnail_validate = $model->uploadThumb();

            } else {
                $thumbnail_validate = true;
            }

            if( isset($uploadedfile) ){


                $file_validate = $model->uploadFile();

            } else {
                $file_validate = true;
            }

            if( $model->validate(["category_id"]) && $thumbnail_validate && $file_validate ){

                $model->save(false);

                return $this->redirect(['update', 'id' => $model->id]);

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
     * Deletes an existing Resources model.
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
     * Finds the Resources model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Resources the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Resources::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionDelthumb($id){

        if( Yii::$app->request->post() ){

            $model = $this->findModel($id);

            $model->thumbnail = '';

            $model->save( false );

            return $this->redirect($_SERVER["HTTP_REFERER"]);

        }

    }

    public function actionDelfile($id){

        if( Yii::$app->request->post() ){

            $model = $this->findModel($id);

            $model->file = '';

            $model->save( false );

            return $this->redirect($_SERVER["HTTP_REFERER"]);

        }

    }


}
