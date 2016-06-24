<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160601_135634_create_unsubscribe_table extends Migration
{
    public function up()
    {
        // unsubscribe
        $this->createTable('{{%unsubscribe}}', [
            'id' => Schema::TYPE_PK,
            'email' => Schema::TYPE_STRING . "(200) NULL",
            'group_id' => Schema::TYPE_INTEGER . "(11) NULL",
        ], $this->tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%unsubscribe}}');
    }
}
