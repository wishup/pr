<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "widgets".
 *
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $description
 *
 * @property WidgetsInAreas[] $widgetsInAreas
 */
class Widgets extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'widgets';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'slug', 'description'], 'required'],
            [['description'], 'string'],
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
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWidgetsInAreas()
    {
        return $this->hasMany(WidgetsInAreas::className(), ['widget_id' => 'id']);
    }
}