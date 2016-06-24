<?php

namespace backend\controllers;

use Yii;
use common\models\User;
use backend\models\UserInfoBackend;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\di\Instance;
use yii\db\Connection;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends BaseController
{
    public $db = 'db';

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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
        ]);

        return $this->dynamic_render('index', [
            'dataProvider' => $dataProvider,
            'grid_fields' => [
                'id',
                'username',
                'email:email',
                //'auth_key',
                //'password_hash',
                //'password_reset_token',

                // 'status',
                //'created_at',
                //'updated_at',
                [
                    "label" => "Created at",
                    "value" => function($model){

                        return date("Y-m-d H:i:s", $model->created_at);
                    },
                    'attribute' => 'created_at'
                ],

                ['class' => 'yii\grid\ActionColumn'],
            ]
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'infomodel' => UserInfoBackend::find()->where("user_id=".$id)->one()
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new \frontend\models\SignupForm();
        $infomodel = new UserInfoBackend();

        if ($model->load(Yii::$app->request->post()) && $infomodel->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                $infomodel->user_id = $user->id;
                $infomodel->save();
                $dbmanager = new \backend\components\DbManager();

                if( Yii::$app->request->post('roles') ){

                    foreach( Yii::$app->request->post('roles') as $role ){

                        $adminItem = $dbmanager->getItemRole($role);

                        $dbmanager->assign( $adminItem, $user->id );

                    }

                }

                return $this->redirect("/backend/user");

            }
        }

        $this->db = Instance::ensure($this->db, Connection::className());

        $query = (new Query)
            ->from('{{%auth_item}}')
            ->where(['type' => 1]);

        $roleitems = [];
        foreach ($query->all($this->db) as $row) {
            $roleitems[$row['name']] = $row['name'];
        }

        return $this->render('create', [
            'model' => $model,
            'infomodel' => $infomodel,
            'roleitems' => $roleitems,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if( !$infomodel = UserInfoBackend::find()->where("user_id=".$id)->one() )
            $infomodel = new UserInfoBackend();

        $this->db = Instance::ensure($this->db, Connection::className());

        $query = (new Query)
            ->from('{{%auth_item}}')
            ->where(['type' => 1]);

        $roleitems = [];
        foreach ($query->all($this->db) as $row) {
            $roleitems[$row['name']] = $row['name'];
        }

        if (Yii::$app->request->post()) {

            $model->email = Yii::$app->request->post("User")["email"];

            if( $model->validate() ){

                if( Yii::$app->request->post("password") != '' ){

                    $model->setPassword( Yii::$app->request->post("password") );

                }
                $infomodel->user_id = $id;
                $infomodel->first_name = Yii::$app->request->post('UserInfoBackend')['first_name'];
                $infomodel->last_name = Yii::$app->request->post('UserInfoBackend')['last_name'];

                $model->save(false);
                $infomodel->save();

                $dbmanager = new \backend\components\DbManager();

                $dbmanager->revokeAll( $model->id );

                if( Yii::$app->request->post('roles') ){

                    foreach( Yii::$app->request->post('roles') as $role ){

                        $adminItem = $dbmanager->getItemRole($role);

                        $dbmanager->assign( $adminItem, $model->id );

                    }

                }

                return $this->redirect(['view', 'id' => $model->id]);

            } else {
                $dbmanager = new \backend\components\DbManager();
                $assignments = $dbmanager->getAssignments( $id );
                $seleditems = [];
                foreach( $assignments as $index=>$assign ) $seleditems[] = $index;

                return $this->render('update', [
                    'model' => $model,
                    'roleitems' => $roleitems,
                    'seleditems' => $seleditems,
                    'infomodel' => $infomodel,
                ]);

            }


        } else {
            $dbmanager = new \backend\components\DbManager();
            $assignments = $dbmanager->getAssignments( $id );
            $seleditems = [];
            foreach( $assignments as $index=>$assign ) $seleditems[] = $index;

            return $this->render('update', [
                'model' => $model,
                'infomodel' => $infomodel,
                'roleitems' => $roleitems,
                'seleditems' => $seleditems,
            ]);
        }
    }

    public function actionProfile()
    {
        $currentUserID = Yii::$app->user->getId();

        $model = $this->findModel($currentUserID);
        if( !$infomodel = UserInfoBackend::find()->where("user_id=".$currentUserID)->one() ){
            $infomodel = new UserInfoBackend();
            $infomodel->user_id = $currentUserID;
        }

        if( yii::$app->request->post() ){

            if(yii::$app->request->post('password')) {
                $hash = Yii::$app->getSecurity()->generatePasswordHash(yii::$app->request->post('password'));
                $model->password_hash = $hash;
            }
            $model->email = yii::$app->request->post('User')['email'];


            $infomodel->user_id = $currentUserID;
            $infomodel->first_name = Yii::$app->request->post('UserInfoBackend')['first_name'];
            $infomodel->last_name = Yii::$app->request->post('UserInfoBackend')['last_name'];

            if($model->validate()){
                $model->save();
                $infomodel->save();
            }

        }



        return $this->render('profile', [
            'model' => $model,
            'infomodel' => $infomodel,
        ]);
    }

    /**
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
