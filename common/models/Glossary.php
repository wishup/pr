<?php

namespace common\models;

use Yii;
use yii\data\ActiveDataProvider;
/**
 * This is the model class for table "glossary".
 *
 * @property integer $id
 * @property string $word
 * @property string $description
 */
class Glossary extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'glossary';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['word', 'description', 'status'], 'required'],
            [['description','status'], 'string'],
            [['word'], 'unique'],
            [['word'], 'string', 'max' => 200],
            [['acronim'], 'string', 'max' => 100],
            [['exclude_from_search'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'word' => 'Word',
            'acronim' => 'Acronym or Aka',
            'description' => 'Description',
            'exclude_from_search' => 'Exclude From Search',
        ];
    }

    public function search($params)
    {
        $query = self::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['word'=>SORT_ASC]]
        ]);

        if (!($this->load($params))) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'word', $this->word]);
        $query->andFilterWhere(['like', 'description', $this->description]);
        $query->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
