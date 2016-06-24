<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Subscription;

/**
 * SubscriptionSearch represents the model behind the search form about `common\models\Subscription`.
 */
class SubscriptionSearch extends Subscription
{
    public $first_name;
    public $last_name;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'subscription_id', 'user_id', 'status'], 'integer'],
            [['amount'], 'number'],
            [['first_name', 'last_name'], 'string'],
            [['created', 'updated'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Subscription::find()->joinWith(array('user' => function ($q) {
            $q->andWhere('season_id='.Seasons::getCurrent()->id);
            $q->joinWith(array('user' => function ($q) {
                $q->joinWith('userInfos');
            }));
        }));
//        $query->leftJoin('users', 'users.id = users_id.user_id and users_id.season_id = '.Seasons::getCurrent()->id);
//        $query->leftJoin('userInfo', 'user_ = users_id.user_id and users_id.season_id = '.Seasons::getCurrent()->id);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'subscription_id' => $this->subscription_id,
            'user_id' => $this->user_id,
            'amount' => $this->amount,
            'status' => $this->status,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'first_name', $this->first_name]);
        $query->andFilterWhere(['like', 'last_nam', $this->last_name]);

        return $dataProvider;
    }
}
