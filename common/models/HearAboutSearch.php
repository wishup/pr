<?php

namespace common\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "hear_about".
 *
 * @property integer $id
 * @property string $answer
 */
class HearAboutSearch extends HearAbout
{
    public $referrals;
    /**
     * @inheritdoc
     */

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['answer'], 'required'],
            [['answer'], 'string', 'max' => 300],
            [['referrals'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'answer' => 'Answer',
        ];
    }

    public function search($params)
    {
        $query = self::find();

        $query->addSelect("`hear_about`.*,(SELECT count(*) FROM `user_info` WHERE `user_info`.`hear_about_us` = `hear_about`.`id`) as `referrals`");

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['referrals'] = [
            'asc' => ['referrals' => SORT_ASC],
            'desc' => ['referrals' => SORT_DESC],
        ];


        $dataProvider->pagination->pageSize = 50;
        if( isset($params["per-page"]) ){
            $dataProvider->pagination->pageSize = $params["per-page"];
        }

        if (!($this->load($params))) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'hear_about.answer', $this->answer]);
        $query->andFilterWhere(['=', '(SELECT count(*) FROM `user_info` WHERE `user_info`.`hear_about_us` = `hear_about`.`id`)', $this->referrals]);


        return $dataProvider;

    }
}
