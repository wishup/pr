<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "shop_categories".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 * @property string $description
 * @property string $image
 */
class ShopCategories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shop_categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['parent_id'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 200],
            [['image'], 'file'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent Category',
            'name' => 'Name',
            'description' => 'Description',
            'image' => 'Image',
        ];
    }
}
