<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160602_124225_create_unsubscribe_reasons_table extends Migration
{
    public function up()
    {
        // unsubscribe_reasons
        $this->createTable('{{%unsubscribe_reasons}}', [
            'id' => Schema::TYPE_PK,
            'reason' => Schema::TYPE_STRING . "(200) NULL",
        ], $this->tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%unsubscribe_reasons}}');
    }
}
