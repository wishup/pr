<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160322_131858_create_live_edit_texts_table extends Migration
{
    public function up()
    {
        // live_edit_texts
        $this->createTable('{{%live_edit_texts}}', [
            'id' => Schema::TYPE_PK,
            'key' => Schema::TYPE_STRING . "(100) NULL",
            'content' => Schema::TYPE_TEXT . " NULL",
        ], $this->tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%live_edit_texts}}');
    }
}
