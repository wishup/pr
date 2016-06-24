<?php

use yii\db\Migration;

class m160421_121924_create_notes extends Migration
{
    public function safeUp()
    {
        $this->createTable('users_notes', [
            'id' => $this->primaryKey(),
            'title' => 'VARCHAR(255) NOT NULL',
            'text' => "TEXT NOT NULL",
            'user_id' => "INT(11) NOT NULL",
            'author_id' => "INT(11) NOT NULL",
            'date' => "TIMESTAMP NOT NULL",
        ]);

        $this->addForeignKey('fk_users_notes_to_users', '{{%users_notes}}', 'user_id', '{{%users}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_users_notes_to_authors', '{{%users_notes}}', 'author_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');


    }

    public function safeDown()
    {
        $this->dropTable('users_notes');
    }
}
