<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160113_083314_create_email_layouts_table extends Migration
{
    public function safeUp()
    {
		// emaillayouts
		$this->createTable('{{%emaillayouts}}', [
			'id' => Schema::TYPE_PK,
			'name' => Schema::TYPE_STRING . "(50) NOT NULL",
			'slug' => Schema::TYPE_STRING . "(50) NOT NULL",
			'path' => Schema::TYPE_STRING . "(100) NOT NULL",
		], $this->tableOptions);
    }

    public function safeDown()
    {
		$this->dropTable('{{%emaillayouts}}');
    }
}
