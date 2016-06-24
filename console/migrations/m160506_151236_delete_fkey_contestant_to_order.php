<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160506_151236_delete_fkey_contestant_to_order extends Migration
{
    public function safeUp()
    {
        $this->dropForeignKey('fk_contesttants_orderid_order_id', '{{%contestants}}');
        $this->addForeignKey('fk_contesttants_orderid_order_id', '{{%contestants}}', 'order_id', '{{%order}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
    }
}
