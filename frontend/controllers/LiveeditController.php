<?php
namespace frontend\controllers;

use Yii;
use frontend\controllers\BaseController;
use common\components\LiveEdit;

/**
 * Site controller
 */
class LiveeditController extends BaseController
{

    public function actionChangestatus(){

        if( LiveEdit::admin() && Yii::$app->request->get("liveedit_status") ){

            if( Yii::$app->request->get("liveedit_status") == 'on' ){

                LiveEdit::on();

            } else {

                LiveEdit::off();

            }

            return json_encode(["success" => "1"]);

        }

        return json_encode(["success" => "0"]);

    }

    public function actionChangeinlinestatus(){

        if( LiveEdit::admin() && Yii::$app->request->get("liveedit_inline_status") ){

            if( Yii::$app->request->get("liveedit_inline_status") == 'on' ){

                LiveEdit::inline_on();

            } else {

                LiveEdit::inline_off();

            }

            return json_encode(["success" => "1"]);

        }

        return json_encode(["success" => "0"]);

    }

    public function actionSavechanges(){

        if( LiveEdit::admin() && ( Yii::$app->request->post("fields") || Yii::$app->request->post("filefields") ) ){

            if( Yii::$app->request->post("fields") ) {

                foreach (Yii::$app->request->post("fields") as $token => $content) {

                    if ($livemodel = \common\models\LiveEdit::find()->where("`token`='" . $token . "'")->one()) {

                        $class = $livemodel->model;
                        $field = $livemodel->field;

                        $model = $class::find()->where("id=" . $livemodel->model_id)->one();

                        switch ($livemodel->encoded) {

                            case "serialize":

                                $c = unserialize($model->$field);

                                $index_arr = explode("%", $livemodel->index);

                                $this->change_arr_value($c, $index_arr, $content);

                                $cont = serialize($c);

                                break;

                            default:
                                $cont = $content;
                                break;

                        }

                        $model->$field = $cont;

                        $model->save(false);

                        $livemodel->delete();

                    }

                }

            }

            if( Yii::$app->request->post("filefields") ) {

                LiveEdit::updateTexts( Yii::$app->request->post("filefields") );

            }

            //LiveEdit::off();

            return 1;

        }

        return 0;

    }

    private function change_arr_value( &$c, $index_arr, $content ){

        if( count($index_arr) > 1 ){

            $this->change_arr_value( $c[ $index_arr[0] ], array_slice($index_arr, 1), $content );

        } else {

            $c[ $index_arr[0] ] = $content;

        }

    }

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;

        return parent::beforeAction($action);
    }

}
