<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160216_075253_create_mailing_tables extends Migration
{
    public function up()
    {
        // mailing
		$this->createTable('{{%mailing}}', [
			'id' => Schema::TYPE_PK,
			'title' => Schema::TYPE_STRING . "(200) NULL",
			'from_name' => Schema::TYPE_STRING . "(100) NULL",
			'from_email' => Schema::TYPE_STRING . "(100) NULL",
			'subject' => Schema::TYPE_STRING . "(300) NULL",
			'message' => Schema::TYPE_TEXT . " NULL",
			'start_at' => Schema::TYPE_DATETIME . " NULL",
			'last_at' => Schema::TYPE_DATETIME . " NULL",
			'frequency' => Schema::TYPE_INTEGER . "(11) NULL",
			'email_count' => Schema::TYPE_INTEGER . "(11) NULL",
			'final_notification' => Schema::TYPE_INTEGER . "(1) NULL",
			'paused' => Schema::TYPE_INTEGER . "(1) NULL",
			'finished' => Schema::TYPE_INTEGER . "(1) NULL",
			'created_at' => Schema::TYPE_DATETIME . " NULL",
		], $this->tableOptions);

		// mailing_users
		$this->createTable('{{%mailing_users}}', [
			'id' => Schema::TYPE_PK,
			'mailing_id' => Schema::TYPE_INTEGER . "(11) NULL",
			'user_id' => Schema::TYPE_INTEGER . "(11) NULL",
			'sent' => Schema::TYPE_INTEGER . "(1) NULL",
			'sent_date' => Schema::TYPE_DATETIME . " NULL",
		], $this->tableOptions);
		
		// fk: mailing_users
		$this->addForeignKey('fk_mailing_users_mailing_id', '{{%mailing_users}}', 'mailing_id', '{{%mailing}}', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('fk_mailing_users_user_id', '{{%mailing_users}}', 'user_id', '{{%users}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%mailing_users}}');
        $this->dropTable('{{%mailing}}');
    }
}
