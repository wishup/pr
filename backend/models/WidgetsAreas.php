<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "widgets_areas".
 *
 * @property integer $id
 * @property string $title
 *
 * @property WidgetsInAreas[] $widgetsInAreas
 */
class WidgetsAreas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'widgets_areas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'slug'], 'required'],
            [['title', 'slug'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'slug' => 'Slug',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWidgetsInAreas()
    {
        return $this->hasMany(WidgetsInAreas::className(), ['area_id' => 'id']);
    }

    public function getWidgets() {
        return $this->hasMany(Widgets::className(), ['id' => 'widget_id'])
            ->viaTable('{{%widgets_in_areas}}', ['area_id' => 'id'], function ($query) {
                return $query->orderBy('order');
            });
    }
}
