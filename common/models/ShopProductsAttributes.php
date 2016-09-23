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
            [['name'], 'string', 'max' => 200],
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
        ];
    }
}
