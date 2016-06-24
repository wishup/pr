<?php
namespace backend\controllers;

use common\models\Contestants;
use common\models\OrderItem;
use common\models\Seasons;
use common\models\UsersFamilies;
use common\models\UsersHosts;
use Yii;
use yii\base\Exception;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use backend\models\UserInfoBackend;
use yii\filters\VerbFilter;

/**
 * Site controller
 */
class SiteController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'statistics', 'error'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index', []);
    }

    public function actionStatistics($type = Null, $return = Null)
    {
        if ($type) {
            Yii::$app->session->set('statistics_type', $type);
        }

        $type = Yii::$app->session->get('statistics_type', 'y');

        $format = "Y-m-d H:i:s";

        $date_to_tms = strtotime('tomorrow');
        $date_to = date($format, $date_to_tms);

        switch ($type) {
            case "d":
                $date_from_tms = strtotime('today');
                break;
            case "w":
                $date_from_tms = strtotime( "monday this week" );
                break;
            case "m":
                $date_from_tms = strtotime('first day of this month');
                break;
            default:
                $date_from_tms = strtotime('first day of January ' . date('Y'));

        }


        $date_from = date($format, $date_from_tms);


        $statistics = array();
        $season_id =  Seasons::getCurrent()->id;


        $statistics['number_of_hosts'] = UsersHosts::find()->join('LEFT JOIN', 'users_id', 'users_id.dynamic_id = users_hosts.user_id')
            ->where("season_id = '$season_id' and created_at <=  '$date_to' and  created_at >= '$date_from' and status=1")->count();
        $statistics['total_number_of_hosts'] = UsersHosts::find()->join('LEFT JOIN', 'users_id', 'users_id.dynamic_id = users_hosts.user_id')
            ->where("season_id = '$season_id' and status=1")->count();
        $statistics['number_of_families'] = UsersFamilies::find()->join('LEFT JOIN', 'users_id', 'users_id.dynamic_id = users_families.user_id')
            ->where("season_id = '$season_id' and created_at <=  '$date_to' and  created_at >= '$date_from' and status=1")->count();
        $statistics['number_of_families_under_host'] = UsersFamilies::find()->join('LEFT JOIN', 'users_id', 'users_id.dynamic_id = users_families.user_id')
            ->where("season_id = '$season_id' and created_at <=  '$date_to' and  created_at >= '$date_from' and status=1 and `users_families`.`id` IN (SELECT `family_id` FROM `family_host`)")->count();
        $statistics['number_of_families_not_under_host'] = UsersFamilies::find()->join('LEFT JOIN', 'users_id', 'users_id.dynamic_id = users_families.user_id')
            ->where("season_id = '$season_id' and created_at <=  '$date_to' and  created_at >= '$date_from' and status=1 and `users_families`.`id` NOT IN (SELECT `family_id` FROM `family_host`)")->count();
        $statistics['total_number_of_families'] = UsersFamilies::find()->join('LEFT JOIN', 'users_id', 'users_id.dynamic_id = users_families.user_id')
            ->where("season_id = '$season_id' and status=1")->count();

        //contestants
        $statistics['number_of_contestants_under_host'] = Contestants::find()->joinWith('order')->join('LEFT JOIN', 'users_id', 'users_id.dynamic_id = `order`.dyn_user_id')
            ->where("season_id = '$season_id' and order.created_at <=  '$date_to' and  order.created_at >= '$date_from' and order.status=1 and `contestants`.`user_id` IN (SELECT `family_host`.`family_id` FROM `family_host`)")->count();

        $statistics['number_of_contestants_not_under_host'] = Contestants::find()->joinWith('order')->join('LEFT JOIN', 'users_id', 'users_id.dynamic_id = `order`.dyn_user_id')
            ->where("season_id = '$season_id' and order.created_at <=  '$date_to' and  order.created_at >= '$date_from' and order.status=1 and `contestants`.`user_id` NOT IN (SELECT `family_host`.`family_id` FROM `family_host`)")->count();

        $statistics['number_of_contestants'] = Contestants::find()->joinWith('order')->join('LEFT JOIN', 'users_id', 'users_id.dynamic_id = `order`.dyn_user_id')
            ->where("season_id = '$season_id' and order.created_at <=  '$date_to' and  order.created_at >= '$date_from' and order.status=1")->count();
        $statistics['total_number_of_contestants'] = Contestants::find()->joinWith('order')->join('LEFT JOIN', 'users_id', 'users_id.dynamic_id = `order`.dyn_user_id')
            ->where("season_id = '$season_id' and order.status=1")->count();

        $statistics['number_of_beginner_contestants'] = Contestants::find()->joinWith('order')->join('LEFT JOIN', 'users_id', 'users_id.dynamic_id = `order`.dyn_user_id')
            ->where("season_id = '$season_id' and age_group = 'Beginner' and order.created_at <=  '$date_to' and  order.created_at >= '$date_from' and order.status=1" )->count();
        $statistics['number_of_primary_contestants'] = Contestants::find()->joinWith('order')->join('LEFT JOIN', 'users_id', 'users_id.dynamic_id = `order`.dyn_user_id')
            ->where("season_id = '$season_id' and age_group = 'Primary' and order.created_at <=  '$date_to' and  order.created_at >= '$date_from' and order.status=1")->count();
        $statistics['number_of_junior_contestants'] = Contestants::find()->joinWith('order')->join('LEFT JOIN', 'users_id', 'users_id.dynamic_id = `order`.dyn_user_id')
            ->where("season_id = '$season_id' and age_group = 'Junior' and order.created_at <=  '$date_to' and  order.created_at >= '$date_from' and order.status=1")->count();
        $statistics['number_of_senior_contestants'] = Contestants::find()->joinWith('order')->join('LEFT JOIN', 'users_id', 'users_id.dynamic_id = `order`.dyn_user_id')
            ->where("season_id = '$season_id' and age_group = 'Senior' and order.created_at <=  '$date_to' and  order.created_at >= '$date_from' and order.status=1")->count();

        //journals
        $statistics['total_journals'] = Contestants::find()->joinWith('order')->join('LEFT JOIN', 'users_id', 'users_id.dynamic_id = `order`.dyn_user_id')
            ->where("season_id = '$season_id' and journal=1")->count();
        $statistics['journals_beginner'] = Contestants::find()->joinWith('order')->join('LEFT JOIN', 'users_id', 'users_id.dynamic_id = `order`.dyn_user_id')
            ->where("season_id = '$season_id' and journal=1 and age_group = 'Beginner' and order.created_at <=  '$date_to' and  order.created_at >= '$date_from' and order.status=1")->count();
        $statistics['journals_primary'] = Contestants::find()->joinWith('order')->join('LEFT JOIN', 'users_id', 'users_id.dynamic_id = `order`.dyn_user_id')
            ->where("season_id = '$season_id' and journal=1 and age_group = 'Primary' and order.created_at <=  '$date_to' and  order.created_at >= '$date_from' and order.status=1")->count();
        $statistics['journals_junior'] = Contestants::find()->joinWith('order')->join('LEFT JOIN', 'users_id', 'users_id.dynamic_id = `order`.dyn_user_id')
            ->where("season_id = '$season_id' and journal=1 and age_group = 'Junior' and order.created_at <=  '$date_to' and  order.created_at >= '$date_from' and order.status=1")->count();
        $statistics['journals_senior'] = Contestants::find()->joinWith('order')->join('LEFT JOIN', 'users_id', 'users_id.dynamic_id = `order`.dyn_user_id')
            ->where("season_id = '$season_id' and journal=1 and age_group = 'Senior' and order.created_at <=  '$date_to' and  order.created_at >= '$date_from' and order.status=1")->count();

        //donations
        $statistics['donations'] = OrderItem::find()->joinWith('order')->join('LEFT JOIN', 'users_id', 'users_id.dynamic_id = `order`.dyn_user_id')
            ->where("season_id = '$season_id' and title = 'Sponsoring' and order.created_at <=  '$date_to' and  created_at >= '$date_from' and order.status=1")->count();

        if ($return) {
            return $statistics;
        }

        return $this->renderPartial('_statistics', array('statistics' => $statistics, 'statistic_type' => $type));
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'login';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $currentUserID = Yii::$app->user->getId();
            $infomodel = UserInfoBackend::find()->where("user_id=" . $currentUserID)->one();
            $infomodel->last_login = date('Y-m-d H:i:s');
            $infomodel->save(false);
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
