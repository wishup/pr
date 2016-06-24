<?php

namespace backend\controllers;

use Yii;
use common\models\Menu;
use common\models\MenuItems;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * MenuController implements the CRUD actions for Menu model.
 */
class MenuController extends BaseController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Menu models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new Menu();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->dynamic_render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'grid_fields' => [
                ['class' => 'yii\grid\SerialColumn'],

                'title',

                ['class' => 'yii\grid\ActionColumn'],
            ]
        ]);
    }

    /**
     * Displays a single Menu model.
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
     * Creates a new Menu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Menu();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Menu model.
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
     * Deletes an existing Menu model.
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
     * Finds the Menu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Menu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Menu::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionNodes(){

        $parent = $_REQUEST["parent"];
        $menu_id = $_REQUEST["menu_id"];

        $parent_id = $parent == '#' ? 0 : (int)$parent;

        $menu_items = MenuItems::getHierarchy( $menu_id, $parent_id );

        $data = array();

        $states = array(
            "success",
            "info",
            "danger",
            "warning"
        );

        if ($parent == "#") {

            foreach( $menu_items as $item ){

                $data[] = array(
                    "id" => $item["model"]->id,
                    "text" => $item["model"]->name,
                    "icon" => "fa fa-".( count($item["childs"]) > 0 ? 'folder' : 'file' )." icon-lg icon-state-".( count($item["childs"]) > 0 ? 'warning' : 'info' ),
                    "children" => ( count($item["childs"]) > 0 ? true : false ),
                    "type" => "root",
                );

            }

        } else {

            foreach( $menu_items as $item ){

                $data[] = array(
                    "id" => $item["model"]->id,
                    "text" => $item["model"]->name,
                    "icon" => "fa fa-".( count($item["childs"]) > 0 ? 'folder' : 'file' )." icon-lg icon-state-".( count($item["childs"]) > 0 ? 'warning' : 'info' ),
                    "children" => ( count($item["childs"]) > 0 ? true : false ),
                );

            }
        }

        header('Content-type: text/json');
        header('Content-type: application/json');
        echo json_encode($data);

        exit;

    }

    public function actionRenameitem(){

        if( Yii::$app->request->post("node_id") && Yii::$app->request->post("name") ){

            $item = MenuItems::find()->where("id=".(int)Yii::$app->request->post("node_id"))->one();

            $item->name = Yii::$app->request->post("name");

            $item->save(false);

            return json_encode(["result"=>1]);

        }

        return json_encode(["result"=>0]);

    }

    public function actionMoveitem(){

        if( Yii::$app->request->post("node_id") ){

            $position = (int)Yii::$app->request->post("position");
            $old_position = (int)Yii::$app->request->post("old_position");
            $parent_id = (int)Yii::$app->request->post("parent_id");
            $menu_id = (int)Yii::$app->request->post("menu_id");

            $item = MenuItems::find()->where("id=".(int)Yii::$app->request->post("node_id"))->one();

            $item->parent_id = $parent_id;
            $item->order = $position;

            $item->save(false);

            $items = MenuItems::find()->where("parent_id=".$parent_id." and menu_id=".$menu_id." and id!=".$item->id)->orderBy("order")->all();

            $pos = 0;

            foreach($items as $it){

                if( $pos == $position ) $pos++;

                $it->order = $pos;

                $it->save(false);

                $pos++;

            }

            return json_encode(["result"=>1]);

        }

        return json_encode(["result"=>0]);

    }

    public function actionDeleteitem(){

        if( Yii::$app->request->post("node_id") ){

            $item = MenuItems::find()->where("id=".(int)Yii::$app->request->post("node_id"))->one();

            $item->delete();

            MenuItems::deleteChilds( (int)Yii::$app->request->post("node_id") );

            return json_encode(["result"=>1]);

        }

        return json_encode(["result"=>0]);

    }

    public function actionCreateitem(){

        if( Yii::$app->request->post("menu_id") && Yii::$app->request->post("name") ){

            $item = new MenuItems();

            $item->parent_id = Yii::$app->request->post("parent_id") ? (int)Yii::$app->request->post("parent_id") : 0;
            $item->menu_id = (int)Yii::$app->request->post("menu_id");
            $item->name = Yii::$app->request->post("name");
            $item->url = '';
            $item->order = Yii::$app->request->post("position") ? (int)Yii::$app->request->post("position") : 0;

            $item->save(false);

            return json_encode(["result"=>1, "id"=>$item->id]);

        }

        return json_encode(["result"=>0]);

    }

    public function beforeAction($action)
    {
        if (in_array($action->id, ['renameitem', 'deleteitem', 'createitem', 'moveitem', 'delete'])) {
            Yii::$app->controller->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }
}
