<?php

namespace backend\controllers;

use Yii;
use common\models\Media;
use yii\web\UploadedFile;
use common\components\attachments;

/**
 * WidgetController implements the CRUD actions for Widgets model.
 */
class MediaController extends BaseController
{

    public function actionIndex()
    {

        if( Yii::$app->request->post("replacefile") && Yii::$app->request->post("file_id") ){

            if( $model = Media::find()->where("id=".(int)Yii::$app->request->post("file_id"))->one() ) {

                $model->attachment = UploadedFile::getInstance($model, 'attachment');

                if ($model->upload()) {

                    $model->size = (string)$model->attachment->size;
                    $model->type = (string)$model->attachment->type;

                    $model->save();

                    \Yii::$app->getSession()->setFlash('success', 'File replaced successfully');

                } else
                    \Yii::$app->getSession()->setFlash('error', 'There was a problem with uploading the file. Please try again.');

            }

        }

        $models = Media::find()->orderBy("id desc")->all();

        return $this->render('index', [
            "models" => $models
        ]);
    }

    public function actionUploadfile(){

        $model = new Media();

        $model->attachment = UploadedFile::getInstance($model, 'attachment');

        if( $model->upload() ){

            $model->size = (string)$model->attachment->size;
            $model->type = (string)$model->attachment->type;

            $model->save();

            $thumbnailURL = in_array($model->type, ['image/jpeg', 'image/png', 'image/gif']) ? attachments::getThumbnailUrl( "/upload/media/".$model->attachment, 80, 50, "CROP" ) : '';

            $json = [
                "files" => [
                    [
                        "name" => (string)$model->attachment,
                        "size" => $model->size,
                        "url" => "/upload/media/".$model->attachment,
                        "thumbnailUrl" => $thumbnailURL,
                        "deleteUrl" => "",
                        "deleteType" => "DELETE",
                    ]
                ]
            ];

            echo json_encode($json);

        } else echo 'error';

    }

    public function actionDelfile($id){

        if( $id ){

            if( $model = Media::find()->where("id=".$id)->one() ){

                $model->delete();

                \Yii::$app->session->setFlash('success', 'Selected file was deleted.');

            }

        }

        return $this->redirect("/backend/media/index");

    }

    public function beforeAction($action)
    {
        if ($action->id == 'uploadfile' || $action->id == 'delfile') {
            Yii::$app->controller->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }

    public function actionTinymce(){

        $models = Media::find()->orderBy("id desc")->all();

        $this->layout = 'tinymce';

        return $this->render('index', [
            "models" => $models,
            "tinymce" => true
        ]);

    }

}
