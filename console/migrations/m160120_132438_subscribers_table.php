<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160120_132438_subscribers_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%subscribers}}', [
            'id' => Schema::TYPE_PK,
            'email' => Schema::TYPE_STRING . "(150) NOT NULL",
            'date' => Schema::TYPE_DATETIME . " NOT NULL",
        ], $this->tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%subscribers}}');
    }
}
