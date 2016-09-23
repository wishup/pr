<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "shop_products".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property double $price
 * @property string $image
 */
class ShopProducts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shop_products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['price'], 'number'],
            [['name'], 'string', 'max' => 300],
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
            'name' => 'Name',
            'description' => 'Description',
            'price' => 'Price',
            'image' => 'Image',
        ];
    }

    public function getCategories()
    {
        return $this->hasMany(ShopCategories::className(), ['id' => 'product_id'])
            ->viaTable(ShopProdCat::tableName(), ['category_id' => 'id']);
    }
}
