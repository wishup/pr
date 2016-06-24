<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160421_125358_create_family_host_table extends Migration
{
    public function up()
    {
        // family_host
		$this->createTable('{{%family_host}}', [
			'id' => Schema::TYPE_PK,
			'family_id' => Schema::TYPE_INTEGER . "(11) NULL",
			'host_id' => Schema::TYPE_INTEGER . "(11) NULL",
		], $this->tableOptions);
		
		$this->addForeignKey('fk_family_host_family_id', '{{%family_host}}', 'family_id', '{{%users_families}}', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('fk_family_host_host_id', '{{%family_host}}', 'host_id', '{{%users_hosts}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%family_host}}');
    }
}
