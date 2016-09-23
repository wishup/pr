<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "shop_prod_cat".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $category_id
 */
class ShopProdCat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shop_prod_cat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'category_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'category_id' => 'Category ID',
        ];
    }
}
