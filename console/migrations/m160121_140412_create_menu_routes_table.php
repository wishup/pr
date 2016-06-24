<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160121_140412_create_menu_routes_table extends Migration
{
    public function safeUp()
    {
		// menu_routes
		$this->createTable('{{%menu_routes}}', [
			'id' => Schema::TYPE_PK,
			'title' => Schema::TYPE_STRING . "(100) NOT NULL",
			'model' => Schema::TYPE_STRING . "(100) NOT NULL",
			'field' => Schema::TYPE_STRING . "(100) NOT NULL",
			'url_template' => Schema::TYPE_STRING . "(200) NOT NULL",
		], $this->tableOptions);
    }

    public function safeDown()
    {
		$this->dropTable('{{%menu_routes}}');
    }
}
