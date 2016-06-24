<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160309_124957_messaging_tables_create extends Migration
{
    public function safeUp()
    {
		// messaging
		$this->createTable('{{%messaging}}', [
			'id' => Schema::TYPE_PK,
			'title' => Schema::TYPE_STRING . "(300) NULL",
			'message' => Schema::TYPE_TEXT . " NULL",
			'start_at' => Schema::TYPE_DATE . " NULL",
			'finish_at' => Schema::TYPE_DATE . " NULL",
			'can_close' => Schema::TYPE_INTEGER . "(1) NULL",
		], $this->tableOptions);

		// messaging_users
		$this->createTable('{{%messaging_users}}', [
			'id' => Schema::TYPE_PK,
			'message_id' => Schema::TYPE_INTEGER . "(11) NULL",
			'user_id' => Schema::TYPE_INTEGER . "(11) NULL",
			'closed' => Schema::TYPE_INTEGER . "(1) NULL",
		], $this->tableOptions);
		
		// fk: messaging_users
		$this->addForeignKey('fk_messaging_users_message_id', '{{%messaging_users}}', 'message_id', '{{%messaging}}', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('fk_messaging_users_user_id', '{{%messaging_users}}', 'user_id', '{{%users}}', 'id', 'CASCADE', 'CASCADE');

    }

    public function safeDown()
    {
		$this->dropTable('{{%messaging_users}}');
		$this->dropTable('{{%messaging}}');
    }
}
