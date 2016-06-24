<?php

use jamband\schemadump\Migration;
use yii\db\Schema;

class m160330_065839_create_orders_and_order_items extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%order}}', [
            'id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER ."(11) NOT NULL",
            'first_name' => Schema::TYPE_STRING . "(100) NOT NULL",
            'last_name' => Schema::TYPE_STRING . "(100) NOT NULL",
            'discount' => Schema::TYPE_DECIMAL ."(6,2) NOT NULL",
            'subtotal' => Schema::TYPE_DECIMAL ."(10,2) NOT NULL",
            'final_price' => Schema::TYPE_DECIMAL ."(10,2) NOT NULL",
            'status' => Schema::TYPE_SMALLINT."(1) NOT NULL",
            'transaction_data' => Schema::TYPE_TEXT. " NULL",
        ], $this->tableOptions);

        $this->createTable('{{%order_item}}', [
            'id' => Schema::TYPE_PK,
            'order_id' => Schema::TYPE_INTEGER ."(11) NOT NULL",
            'title'=> Schema::TYPE_STRING . "(100) NOT NULL",
            'price' => Schema::TYPE_DECIMAL ."(6,2) NOT NULL",
            'quantity' => Schema::TYPE_SMALLINT."(4) NOT NULL",
            'subtotal' => Schema::TYPE_DECIMAL ."(10,2) NOT NULL",
        ], $this->tableOptions);

        $this->addForeignKey('fk_order_user_id_family_id', '{{%order}}', 'user_id', '{{%users_families}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_order_item_order_id_order_id', '{{%order_item}}', 'order_id', '{{%order}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('{{%order_item}}');
        $this->dropTable('{{%order}}');
    }
}
