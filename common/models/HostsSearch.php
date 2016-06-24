<?php

namespace common\models;

use Yii;
use yii\data\ActiveDataProvider;
use common\models\Seasons;
use common\models\UsersId;
use common\models\UserInfo;
use common\models\UserCheck;
use common\components\Email;
use yii\db\Expression;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $email
 * @property string $password
 * @property string $created_at
 * @property string $updated_at
 * @property integer $status
 *
 * @property UserInfo[] $userInfos
 * @property UsersId[] $users
 */
class HostsSearch extends Users
{
    public $first_name;
    public $last_name;
    public $tags;
    public $state;
    public $zip;
    public $address_1;
    public $city;
    public $ssn;
    public $check_status;
    public $host_id;
    public $host_status;
    public $hostedcount;
    public $phone;
    public $age;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'password', 'status'], 'required'],
            [['created_at', 'updated_at', 'first_name','host_id', 'age', 'phone', 'last_name', 'tags', 'state', 'zip', 'city', 'address_1', 'ssn', 'check_status', 'h_cs_status', 'host_status', 'hostedcount'], 'safe'],
            [['status'], 'integer'],
            [['email'], 'email'],
            [['email'], 'unique'],
            [['email'], 'string', 'max' => 255],
            [['confirm_code'], 'string', 'max' => 50],
            [['password'], 'string', 'length' => [6,100]]
        ];
    }

    public function hostcount(){

        $user_id = Users::getUserID( $this->id );

        $hostmodel = UsersHosts::find()->where("user_id=".$user_id)->one();

        return $hostmodel->hostcount;

    }

    public function search($params)
    {
        $query = self::find();
        $query->joinWith('userInfos');
        $query->leftJoin('users_id', '`users_id`.`user_id` = `users`.`id`');
        $query->leftJoin('user_check', '`user_check`.`user_id` = `users_id`.`dynamic_id`');
        $query->leftJoin('users_hosts', '`users_hosts`.`user_id` = `users_id`.`dynamic_id`');
        $query->where("users_id.season_id=".Seasons::getCurrent()->id." AND users_hosts.id IS NOT NULL");

        $query->addSelect('`users`.*, TIMESTAMPDIFF(YEAR, `user_info`.`date_of_birth`, CURDATE()) AS age, users_hosts.id as host_id, `users_hosts`.status as host_status, (SELECT COUNT(*) FROM `contestants` WHERE `contestants`.`status`=1 AND `contestants`.`user_id`  IN ( SELECT `family_host`.`family_id` FROM `family_host` WHERE `family_host`.`host_id`=`users_hosts`.`id` )) as hostedcount, user_check.status as check_status');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['last_name'=>SORT_ASC]],
        ]);

        $dataProvider->sort->attributes['first_name'] = [
            'asc' => [new Expression("IF(user_info.first_name IS NULL OR '' = user_info.first_name, 'ZZZZZZZZ', user_info.first_name) ASC")],
            'desc' => [new Expression("IF(user_info.first_name IS NULL OR '' = user_info.first_name, 'ZZZZZZZZ', user_info.first_name) DESC" )],
        ];
        $dataProvider->sort->attributes['last_name'] = [
            'asc' => [new Expression("IF(user_info.last_name IS NULL OR '' = user_info.last_name, 'ZZZZZZZZ', user_info.last_name) ASC")],
            'desc' => [new Expression("IF(user_info.last_name IS NULL OR '' = user_info.last_name, 'ZZZZZZZZ', user_info.last_name) DESC" )],
        ];

        $dataProvider->sort->attributes['host_id'] = [
            'asc' => ['users_hosts.id' => SORT_ASC],
            'desc' => ['users_hosts.id' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['age'] = [
            'asc' => ['age' => SORT_ASC],
            'desc' => ['age' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['tags'] = [
            'asc' => ['user_info.tags' => SORT_ASC],
            'desc' => ['user_info.tags' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['phone'] = [
            'asc' => ['user_info.phone' => SORT_ASC],
            'desc' => ['user_info.phone' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['state'] = [
            'asc' => ['user_info.state' => SORT_ASC],
            'desc' => ['user_info.state' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['zip'] = [
            'asc' => ['user_info.zip' => SORT_ASC],
            'desc' => ['user_info.zip' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['city'] = [
            'asc' => ['user_info.city' => SORT_ASC],
            'desc' => ['user_info.city' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['address_1'] = [
            'asc' => ['user_info.address_1' => SORT_ASC],
            'desc' => ['user_info.address_1' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['ssn'] = [
            'asc' => ['user_info.ssn' => SORT_ASC],
            'desc' => ['user_info.ssn' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['h_cs_status'] = [
            'desc' => ['users.h_cs_status' => SORT_ASC],
            'asc' => ['users.h_cs_status' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['host_status'] = [
            'asc' => ['users_hosts.status' => SORT_ASC],
            'desc' => ['users_hosts.status' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['hostedcount'] = [
            'asc' => ['hostedcount' => SORT_ASC],
            'desc' => ['hostedcount' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['check_status'] = [
            'asc' => ['check_status' => SORT_ASC],
            'desc' => ['check_status' => SORT_DESC],
        ];

        if (!($this->load($params))) {
            return $dataProvider;
        }

        if( isset($params["per-page"]) ) $dataProvider->pagination->pageSize = $params["per-page"];

        $query->andFilterWhere(['like', 'users_hosts.id', $this->host_id]);
        $query->andFilterWhere(['like', 'users.email', $this->email]);
        $query->andFilterWhere(['like', 'users.status', $this->status]);
        $query->andFilterWhere(['like', 'users.created_at', $this->created_at]);
        $query->andFilterWhere(['like', 'users.updated_at', $this->updated_at]);
        $query->andFilterWhere(['like', 'user_info.first_name', $this->first_name]);
        $query->andFilterWhere(['like', 'user_info.last_name', $this->last_name]);
        $query->andFilterWhere(['like', 'user_info.tags', $this->tags]);
        $query->andFilterWhere(['like', 'user_info.phone', $this->phone]);
        $query->andFilterWhere(['like', 'user_info.state', $this->state]);
        $query->andFilterWhere(['like', 'user_info.zip', $this->zip]);
        $query->andFilterWhere(['like', 'user_info.city', $this->city]);
        $query->andFilterWhere(['like', 'user_info.address_1', $this->address_1]);
        $query->andFilterWhere(['like', 'user_info.ssn', $this->ssn]);
        $query->andFilterWhere(['=', '( TIMESTAMPDIFF(YEAR, `user_info`.`date_of_birth`, CURDATE()) )', $this->age]);
        $query->andFilterWhere(['like', '(SELECT COUNT(*) FROM `contestants` WHERE `contestants`.`status`=1 AND `contestants`.`user_id`  IN ( SELECT `family_host`.`family_id` FROM `family_host` WHERE `family_host`.`host_id`=`users_hosts`.`id` ))', $this->hostedcount]);

        $query->andFilterWhere(['users.h_cs_status' => $this->h_cs_status]);


        if( $this->host_status == 'empty' ){
            $query->andWhere(['is', 'users_hosts.status', null]);
        } else {
            $query->andFilterWhere(['users_hosts.status'=> $this->host_status]);
        }

        if( $this->check_status == 'empty' ){
            $query->andWhere(['=', 'user_check.status', '']);
        } else {
            $query->andFilterWhere(['user_check.status' => $this->check_status]);
        }

        return $dataProvider;
    }

}
