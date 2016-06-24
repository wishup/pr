<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m151215_141704_emailtemplates_table_create extends Migration
{
    public function safeUp()
    {
		// emailtemplates
		$this->createTable('{{%emailtemplates}}', [
			'id' => Schema::TYPE_PK,
			'title' => Schema::TYPE_STRING . "(200) NOT NULL",
			'subject' => Schema::TYPE_STRING . "(300) NOT NULL",
			'from_name' => Schema::TYPE_STRING . "(100) NOT NULL",
			'from_email' => Schema::TYPE_STRING . "(100) NOT NULL",
			'content' => Schema::TYPE_TEXT . " NOT NULL",
			'plaintext' => Schema::TYPE_TEXT . " NOT NULL",
			'shortcodes' => Schema::TYPE_TEXT . " NOT NULL",
		], $this->tableOptions);
    }

    public function safeDown()
    {
		$this->dropTable('{{%emailtemplates}}');
    }
}
