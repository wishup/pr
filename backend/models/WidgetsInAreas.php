<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "widgets_in_areas".
 *
 * @property integer $id
 * @property integer $widget_id
 * @property integer $area_id
 * @property string $params
 *
 * @property Widgets $widget
 * @property WidgetsAreas $area
 */
class WidgetsInAreas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'widgets_in_areas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['widget_id', 'area_id', 'params'], 'required'],
            [['widget_id', 'area_id', 'order'], 'integer'],
            [['params'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'widget_id' => 'Widget ID',
            'area_id' => 'Area ID',
            'params' => 'Params',
            'order' => 'Order',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWidget()
    {
        return $this->hasOne(Widgets::className(), ['id' => 'widget_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArea()
    {
        return $this->hasOne(WidgetsAreas::className(), ['id' => 'area_id']);
    }
}
