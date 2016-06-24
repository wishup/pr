<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160120_133634_faq_categories_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%faq_categories}}', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . "(100) NOT NULL",
        ], $this->tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%faq_categories}}');
    }
}
