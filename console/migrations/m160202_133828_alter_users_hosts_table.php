<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160202_133828_alter_users_hosts_table extends Migration
{
    public function safeUp()
    {
		$this->dropColumn('{{%users_hosts}}', 'summer_event_info');
		$this->dropColumn('{{%users_hosts}}', 'celeb_day_info');
    }

    public function safeDown()
    {
		$this->addColumn('{{%users_hosts}}', 'summer_event_info', Schema::TYPE_STRING."(300) NOT NULL");
		$this->addColumn('{{%users_hosts}}', 'celeb_day_info', Schema::TYPE_STRING."(300) NOT NULL");
    }
}
