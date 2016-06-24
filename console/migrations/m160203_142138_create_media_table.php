<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160203_142138_create_media_table extends Migration
{
    public function safeUp()
    {
		// media
		$this->createTable('{{%media}}', [
			'id' => Schema::TYPE_PK,
			'attachment' => Schema::TYPE_STRING . "(300) NOT NULL",
			'size' => Schema::TYPE_STRING . "(100) NOT NULL",
			'type' => Schema::TYPE_STRING . "(100) NOT NULL",
		], $this->tableOptions);
    }

    public function safeDown()
    {
		$this->dropTable('{{%media}}');
    }
}
