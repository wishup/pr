<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m161012_084540_add_comments_table extends Migration
{
    public function safeUp()
    {
        // post_comments
        $this->createTable('{{%post_comments}}', [
            'id' => Schema::TYPE_PK,
            'post_id' => Schema::TYPE_INTEGER . "(11) NULL",
            'comment' => Schema::TYPE_TEXT . " NULL",
            'answer' => Schema::TYPE_TEXT . " NULL",
            'name' => Schema::TYPE_STRING . "(300) NULL",
            'email' => Schema::TYPE_STRING . "(300) NULL",
            'status' => Schema::TYPE_INTEGER . "(1) NULL",
            'date' => Schema::TYPE_DATETIME . " NULL",
        ], $this->tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('post_comments');
    }
}
