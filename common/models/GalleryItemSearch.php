<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\GalleryItem;

/**
 * GalleryItemSearch represents the model behind the search form about `common\models\GalleryItem`.
 */
class GalleryItemSearch extends GalleryItem
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'gallery_id'], 'integer'],
            [['name', 'description', 'image'], 'safe'],
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
    public function search($params, $gallery_id = 0)
    {
        $query = GalleryItem::find();

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
        ]);

        if( $gallery_id ){
            $query->andFilterWhere([
                'gallery_id' => $gallery_id,
            ]);
        }

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'image', $this->image]);

        return $dataProvider;
    }
}
