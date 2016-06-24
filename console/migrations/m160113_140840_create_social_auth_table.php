<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160113_140840_create_social_auth_table extends Migration
{
    public function safeUp()
    {
		// social_auth
		$this->createTable('{{%social_auth}}', [
			'id' => Schema::TYPE_PK,
			'user_id' => Schema::TYPE_INTEGER . "(11) NOT NULL",
			'source' => Schema::TYPE_STRING . "(255) NOT NULL",
			'source_id' => Schema::TYPE_STRING . "(255) NOT NULL",
		], $this->tableOptions);
		
		$this->addForeignKey('fk_social_auth_user_id', '{{%social_auth}}', 'user_id', '{{%users}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
		$this->dropTable('{{%social_auth}}');
    }
}
