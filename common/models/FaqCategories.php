<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "faq_categories".
 *
 * @property integer $id
 * @property string $name
 */
class FaqCategories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'faq_categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 100]
        ];
    }

    public function getFaq()
    {
        return $this->hasMany(Faq::className(), ['category_id' => 'id']);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    public function getFaqByStatus( $status ){

        $models = Faq::find()->where("category_id=".$this->id." and status='".$status."'")->all();

        return $models;

    }
}
