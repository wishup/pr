<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160223_123525_delete_html_pages extends Migration
{
    public function safeUp()
    {
		
		$this->dropForeignKey('fk_pages_html_page_id', '{{%pages}}');
		
        $this->dropColumn('{{%pages}}', 'type');
        $this->dropColumn('{{%pages}}', 'html_page_id');
		
        $this->dropTable('{{%html_pages}}');
    }

    public function safeDown()
    {
        $this->createTable('{{%html_pages}}', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . "(100) NOT NULL",
            'content' => Schema::TYPE_TEXT . " NOT NULL",
        ], $this->tableOptions);
		
		$this->addColumn('{{%pages}}', 'type', $this->integer(1));
        $this->addColumn('{{%pages}}', 'html_page_id', $this->integer(11));

        $this->addForeignKey('fk_pages_html_page_id', '{{%pages}}', 'html_page_id', '{{%html_pages}}', 'id', 'CASCADE', 'CASCADE');
		
    }
}
