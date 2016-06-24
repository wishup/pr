<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160205_101225_create_widgets_in_layouts_table extends Migration
{
    public function safeUp()
    {
		// widgets_in_layouts
		$this->createTable('{{%widgets_in_layouts}}', [
			'id' => Schema::TYPE_PK,
			'widget_id' => Schema::TYPE_INTEGER . "(11) NOT NULL",
			'layout_id' => Schema::TYPE_INTEGER . "(11) NOT NULL",
			'position' => Schema::TYPE_STRING . "(50) NOT NULL",
			'title' => Schema::TYPE_STRING . "(300) NOT NULL",
			'params' => Schema::TYPE_TEXT . " NOT NULL",
			'order' => Schema::TYPE_INTEGER . "(11) NOT NULL",
			'order' => Schema::TYPE_STRING . "(30) NOT NULL",
		], $this->tableOptions);

		// fk: widgets_in_layouts
		$this->addForeignKey('fk_widgets_in_layouts_layout_id', '{{%widgets_in_layouts}}', 'layout_id', '{{%layouts}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
		$this->dropTable('{{%widgets_in_layouts}}');
    }
}
