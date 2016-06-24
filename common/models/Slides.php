<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "slides".
 *
 * @property integer $id
 * @property integer $slider_id
 * @property string $slide
 *
 * @property Sliders $slider
 */
class Slides extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'slides';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['slide'], 'required'],
            [['slide'], 'file'],
            [['order'], 'integer'],
            [['link'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'slider_id' => 'Slider ID',
            'slide' => 'Slide',
            'order' => 'Order',
            'link' => 'Link',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSlider()
    {
        return $this->hasOne(Sliders::className(), ['id' => 'slider_id']);
    }
}
