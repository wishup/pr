<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160408_092628_add_orderid_to_chilren_and_delete_status extends Migration
{
    public function safeUp()
    {
        $this->dropColumn('{{%contestants}}', 'status' );
        $this->addColumn('{{%contestants}}', 'order_id', Schema::TYPE_INTEGER ."(11) NULL");
        $this->addForeignKey('fk_contesttants_orderid_order_id', '{{%contestants}}', 'order_id', '{{%order}}', 'id', 'CASCADE', 'CASCADE');

    }

    public function safeDown()
    {
        $this->addColumn('{{%contestants}}', 'status', Schema::TYPE_BOOLEAN ." NOT NULL DEFAULT FALSE");
        $this->dropColumn('{{%contestants}}', 'order_id' );
    }
}
