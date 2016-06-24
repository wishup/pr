<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160216_121033_create_users_tokens_table extends Migration
{
    public function up()
    {
        // users_tokens
		$this->createTable('{{%users_tokens}}', [
			'id' => Schema::TYPE_PK,
			'user_id' => Schema::TYPE_INTEGER . "(11) NULL",
			'token' => Schema::TYPE_STRING . "(100) NULL",
			'slug' => Schema::TYPE_STRING . "(50) NULL",
		], $this->tableOptions);
		
		// fk: users_tokens
		$this->addForeignKey('fk_users_tokens_user_id', '{{%users_tokens}}', 'user_id', '{{%users}}', 'id');
    }

    public function down()
    {
        $this->dropTable('{{%users_tokens}}');
    }
}
