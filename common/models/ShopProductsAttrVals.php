<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "shop_products_attr_vals".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $attribute_id
 * @property string $value
 */
class ShopProductsAttrVals extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shop_products_attr_vals';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'attribute_id'], 'integer'],
            [['value'], 'string'],
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
            'attribute_id' => 'Attribute ID',
            'value' => 'Value',
        ];
    }
}
