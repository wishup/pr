<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160307_083643_alter_user_check_table extends Migration
{
    public function safeUp()
    {
		$this->addColumn('{{%user_check}}', 'status_changed_at', $this->datetime());
		$this->addColumn('{{%user_check}}', 'approved_at', $this->datetime());
    }

    public function safeDown()
    {
		$this->dropColumn('{{%user_check}}', 'status_changed_at');
		$this->dropColumn('{{%user_check}}', 'approved_at');
    }
}
