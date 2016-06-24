<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "resources_categories".
 *
 * @property integer $id
 * @property string $title
 * @property string $subtitle
 */
class ResourcesCategories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'resources_categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'subtitle'], 'string', 'max' => 200],
            [['image'], 'file', 'extensions' => 'png, jpg, gif, jpeg', 'maxSize' => 1024 * 1024 * 2],
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
            'subtitle' => 'Subtitle',
            'image' => 'Default thumbnail',
        ];
    }
}
