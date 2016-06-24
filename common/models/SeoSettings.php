<?php

namespace common\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "seo_settings".
 *
 * @property integer $id
 * @property string $default_url
 * @property string $rewrite_url
 */
class SeoSettings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'seo_settings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['default_url'], 'required'],
            [['default_url', 'rewrite_url'], 'trimslashes'],
            [['default_url', 'rewrite_url'], 'unique'],
            [['default_url', 'rewrite_url'], 'string', 'max' => 300],
            ['default_url', 'checkDefaultUrl']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'default_url' => 'Base Url',
            'rewrite_url' => 'Rewrite Url',
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

        $query->andFilterWhere(['like', 'default_url', $this->default_url]);
        $query->andFilterWhere(['like', 'rewrite_url', $this->rewrite_url]);

        return $dataProvider;
    }

    public function checkDefaultUrl($attribute, $params)
    {

        if( $seo = SeoSettings::find()->where("rewrite_url='".$this->$attribute."' OR rewrite_url='".( substr($this->$attribute,0,1) == '/' ? substr($this->$attribute,1) : '/'.$this->$attribute )."'")->one() ){

            $this->addError($attribute, 'You entered a rewrite URL for "'.$seo->default_url.'". Please use system URLs in this field.');

        }

    }

    public function trimslashes($attribute, $params)
    {
        $this->$attribute = trim($this->$attribute, ' /');

    }
}
