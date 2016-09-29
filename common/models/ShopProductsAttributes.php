<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "shop_products_attributes".
 *
 * @property integer $id
 * @property string $name
 */
class ShopProductsAttributes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shop_products_attributes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'slug'], 'string', 'max' => 200],
            [["name", "slug"], "required"],
            ["slug", "unique"]
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
            'slug' => 'Slug',
        ];
    }
}
