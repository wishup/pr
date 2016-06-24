<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "layouts_widgets_areas".
 *
 * @property integer $id
 * @property integer $layout_id
 * @property string $section
 * @property integer $widget_area_id
 *
 * @property Layouts $layout
 * @property WidgetsAreas $widgetArea
 */
class LayoutsWidgetsAreas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'layouts_widgets_areas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['layout_id', 'section', 'widget_area_id'], 'required'],
            [['layout_id', 'widget_area_id'], 'integer'],
            [['section'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'layout_id' => 'Layout ID',
            'section' => 'Section',
            'widget_area_id' => 'Widget Area ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLayout()
    {
        return $this->hasOne(Layouts::className(), ['id' => 'layout_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWidgetArea()
    {
        return $this->hasOne(WidgetsAreas::className(), ['id' => 'widget_area_id']);
    }
}
