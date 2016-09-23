<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

/**
 * Handles the creation for table `shop_tables`.
 */
class m160923_100444_create_shop_tables extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        // shop_categories
        $this->createTable('{{%shop_categories}}', [
            'id' => Schema::TYPE_PK,
            'parent_id' => Schema::TYPE_INTEGER . "(11) NULL",
            'name' => Schema::TYPE_STRING . "(200) NULL",
            'description' => Schema::TYPE_TEXT . " NULL",
            'image' => Schema::TYPE_STRING . "(200) NULL",
        ], $this->tableOptions);

// shop_products
        $this->createTable('{{%shop_products}}', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . "(300) NULL",
            'description' => Schema::TYPE_TEXT . " NULL",
            'price' => Schema::TYPE_FLOAT . " NULL",
            'image' => Schema::TYPE_STRING . "(300) NULL",
        ], $this->tableOptions);

// shop_products_attr_vals
        $this->createTable('{{%shop_products_attr_vals}}', [
            'id' => Schema::TYPE_PK,
            'product_id' => Schema::TYPE_INTEGER . "(11) NULL",
            'attribute_id' => Schema::TYPE_INTEGER . "(11) NULL",
            'value' => Schema::TYPE_TEXT . " NULL",
        ], $this->tableOptions);

// shop_products_attributes
        $this->createTable('{{%shop_products_attributes}}', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . "(200) NULL",
        ], $this->tableOptions);

        // shop_prod_cat
        $this->createTable('{{%shop_prod_cat}}', [
            'id' => Schema::TYPE_PK,
            'product_id' => Schema::TYPE_INTEGER . "(11) NULL",
            'category_id' => Schema::TYPE_INTEGER . "(11) NULL",
        ], $this->tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('shop_products_attr_vals');
        $this->dropTable('shop_products_attributes');
        $this->dropTable('shop_products');
        $this->dropTable('shop_categories');
        $this->dropTable('shop_prod_cat');
    }
}
