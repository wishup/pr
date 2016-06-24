<?php

namespace backend\controllers;

use Yii;
use common\models\LiveEditTexts;
use common\models\LiveEditTextsSearch;
use backend\controllers\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LiveEditTextsController implements the CRUD actions for LiveEditTexts model.
 */
class LiveEditTextsController extends BaseController
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
     * Lists all LiveEditTexts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LiveEditTextsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->dynamic_render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'grid_fields' => [
                'id',
                //'key',
                'content:html',

                ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}'],
            ]
        ]);
    }

    /**
     * Displays a single LiveEditTexts model.
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
     * Creates a new LiveEditTexts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new LiveEditTexts();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing LiveEditTexts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing LiveEditTexts model.
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
     * Finds the LiveEditTexts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LiveEditTexts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LiveEditTexts::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionUpdatefield()
    {

        $class = Yii::$app->request->get("model");
        $field = Yii::$app->request->get("field_name");

        $model = $class::find()->where("id=" . (int)Yii::$app->request->get("model_id"))->one();



        if( Yii::$app->request->post() ){

            $content = Yii::$app->request->post("field_value");

            switch (Yii::$app->request->get("encoded")) {

                case "serialize":

                    $c = unserialize($model->$field);

                    $index_arr = explode("%", Yii::$app->request->get("index"));

                    $this->change_arr_value($c, $index_arr, $content);

                    $cont = serialize($c);

                    break;

                default:
                    $cont = $content;
                    break;

            }

            $model->$field = $cont;

            $model->save(false);

        }

        switch (Yii::$app->request->get("encoded")) {

            case "serialize":

                $c = unserialize($model->$field);

                $index_arr = explode("%", Yii::$app->request->get("index"));

                $field_val = $this->get_arr_value($c, $index_arr);

                break;

            default:
                $field_val = $model->$field;
                break;

        }

        return $this->render('updatefield', [
            "field_val" => $field_val,
        ]);
    }

    private function change_arr_value( &$c, $index_arr, $content ){

        if( count($index_arr) > 1 ){

            $this->change_arr_value( $c[ $index_arr[0] ], array_slice($index_arr, 1), $content );

        } else {

            $c[ $index_arr[0] ] = $content;

        }

    }

    private function get_arr_value( &$c, $index_arr ){

        if( count($index_arr) > 1 ){

            return $this->get_arr_value( $c[ $index_arr[0] ], array_slice($index_arr, 1) );

        } else {

             return $c[ $index_arr[0] ];

        }

    }
}
