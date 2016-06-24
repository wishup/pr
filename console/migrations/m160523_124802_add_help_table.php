<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160523_124802_add_help_table extends Migration
{
    public function safeUp()
    {
        // help
        $this->createTable('{{%help}}', [
            'id' => Schema::TYPE_PK,
            'content' => Schema::TYPE_TEXT . " NULL",
        ], $this->tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%help}}');
    }
}
