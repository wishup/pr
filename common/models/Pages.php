<?php

namespace common\models;

use Yii;
use yii\data\ActiveDataProvider;
use backend\models\PagesRevisions;

/**
 * This is the model class for table "pages".
 *
 * @property integer $id
 * @property string $name
 * @property string $header
 * @property string $content
 * @property string $controller
 * @property string $action
 * @property string $params
 *
 * @property HtmlPages $htmlPage
 */
class Pages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['content'], 'string'],
            [['name', 'header'], 'string', 'max' => 300],
            [['exclude_from_search'], 'integer'],
            [['status'], 'string'],
            [['password'], 'string', 'min'=> 6, 'max'=> 12]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'header' => 'Header',
            'content' => 'Content',
            'exclude_from_search' => 'Exclude From Search',
            'status' => 'Status',
            'password' => 'Password',
        ];
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

        $query->andFilterWhere(['like', 'name', $this->name]);
        $query->andFilterWhere(['=', 'created_at', $this->created_at]);
        $query->andFilterWhere(['=', 'updated_at', $this->updated_at]);

        return $dataProvider;
    }

}
