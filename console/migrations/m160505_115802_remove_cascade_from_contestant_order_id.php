<?php

use jamband\schemadump\Migration;
use yii\db\Schema;

class m160505_115802_remove_cascade_from_contestant_order_id extends Migration
{
    public function safeUp()
    {
		$this->dropForeignKey('fk_contesttants_orderid_order_id', '{{%contestants}}');
		$this->addForeignKey('fk_contesttants_orderid_order_id', '{{%contestants}}', 'order_id', '{{%order}}', 'id');
    }

    public function safeDown()
    {
    }
}
