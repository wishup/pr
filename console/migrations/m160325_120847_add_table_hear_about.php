<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160325_120847_add_table_hear_about extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%hear_about}}', [
            'id' => Schema::TYPE_PK,
            'answer' => Schema::TYPE_STRING . "(300) NOT NULL",
        ], $this->tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%hear_about}}');
    }
}
