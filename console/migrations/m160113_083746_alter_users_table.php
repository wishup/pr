<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160113_083746_alter_users_table extends Migration
{
    public function safeUp()
    {
		$this->addColumn('{{%users}}', 'confirm_code', Schema::TYPE_STRING."(50) NOT NULL");
    }

    public function safeDown()
    {
		$this->dropColumn('{{%users}}', 'confirm_code');
    }
}
