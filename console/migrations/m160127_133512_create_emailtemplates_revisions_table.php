<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160127_133512_create_emailtemplates_revisions_table extends Migration
{
    public function safeUp()
    {
		// emailtemplates_revisions
		$this->createTable('{{%emailtemplates_revisions}}', [
			'id' => Schema::TYPE_PK,
			'emailtemplate_id' => Schema::TYPE_INTEGER . "(11) NOT NULL",
			'user_id' => Schema::TYPE_INTEGER . "(11) NOT NULL",
			'content' => Schema::TYPE_TEXT . " NOT NULL",
			'plaintext' => Schema::TYPE_TEXT . " NOT NULL",
			'date' => Schema::TYPE_DATETIME . " NOT NULL",
			'action' => Schema::TYPE_STRING . "(50) NOT NULL",
		], $this->tableOptions);
		
		// fk: emailtemplates_revisions
		$this->addForeignKey('fk_emailtemplates_revisions_user_id', '{{%emailtemplates_revisions}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('fk_emailtemplates_revisions_emailtemplate_id', '{{%emailtemplates_revisions}}', 'emailtemplate_id', '{{%emailtemplates}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
		$this->dropTable('{{%emailtemplates_revisions}}');
    }
}
