<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Resources;

/**
 * ResourcesSearch represents the model behind the search form about `common\models\Resources`.
 */
class ResourcesSearch extends Resources
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'version'], 'integer'],
            [['age_group', 'overlay_text', 'thumbnail', 'file'], 'safe'],
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
        $query = Resources::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->pagination->pageSize = 50;
        if( isset($params["per-page"]) ){
            $dataProvider->pagination->pageSize = $params["per-page"];
        }

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
        ]);

        if( $this->version == '0' ){

            $query->andWhere("version is null or version=''");

        } else {

            $query->andFilterWhere([
                'version' => $this->version,
            ]);

        }

        if( $this->age_group == 'all' ){

            $query->andWhere("age_group is null or age_group=''");

        } else {

            $query->andFilterWhere([
                'age_group' => $this->age_group,
            ]);

        }

        $query
            ->andFilterWhere(['like', 'overlay_text', $this->overlay_text])
            ->andFilterWhere(['like', 'thumbnail', $this->thumbnail])
            ->andFilterWhere(['like', 'file', $this->file]);

        return $dataProvider;
    }
}
