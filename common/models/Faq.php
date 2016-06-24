<?php

namespace common\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "faq".
 *
 * @property integer $id
 * @property string $question
 * @property string $answer
 */
class Faq extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'faq';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['question', 'answer', 'status'], 'required'],
            [['question', 'answer', 'status'], 'string'],
            [['exclude_from_search','category_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'question' => 'Question',
            'answer' => 'Answer',
            'exclude_from_search' => 'Exclude From Search',
            'category_id' => 'Category',
        ];
    }

    public function getFaqcategories()
    {
        return $this->hasOne(FaqCategories::className(), ['id' => 'category_id']);
    }

    public function search($params)
    {

        $query = self::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params))) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'question', $this->question]);
        $query->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }

}
