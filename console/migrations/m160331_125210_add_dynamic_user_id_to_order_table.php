<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160331_125210_add_dynamic_user_id_to_order_table extends Migration
{
    public function up()
    {
		$this->addColumn('{{%order}}', 'dyn_user_id', $this->integer());
		
		$this->addForeignKey('fk_order_dyn_user_id_users_id', '{{%order}}', 'dyn_user_id', '{{%users_id}}', 'dynamic_id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
		$this->dropColumn('{{%order}}', 'dyn_user_id');
    }
}
