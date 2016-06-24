<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m151214_120755_emails_table_create extends Migration
{
    public function safeUp()
    {
		// emails
		$this->createTable('{{%emails}}', [
			'id' => Schema::TYPE_PK,
			'from_name' => Schema::TYPE_STRING . "(150) NOT NULL",
			'from_email' => Schema::TYPE_STRING . "(150) NOT NULL",
			'to_name' => Schema::TYPE_STRING . "(150) NOT NULL",
			'to_email' => Schema::TYPE_STRING . "(150) NOT NULL",
			'subject' => Schema::TYPE_STRING . "(300) NOT NULL",
			'content' => Schema::TYPE_TEXT . " NOT NULL",
			'attachments' => Schema::TYPE_TEXT . " NOT NULL",
			'hash' => Schema::TYPE_STRING . "(50) NOT NULL",
			'priority' => Schema::TYPE_INTEGER . "(11) NOT NULL",
			'status' => Schema::TYPE_STRING . "(30) NOT NULL",
			'send_date' => Schema::TYPE_DATE . " NULL",
			'created_at' => Schema::TYPE_DATETIME . " NULL",
			'sent_at' => Schema::TYPE_DATETIME . " NULL",
		], $this->tableOptions);
    }

    public function safeDown()
    {
		$this->dropTable('{{%emails}}');
    }
}
