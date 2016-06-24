<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160328_123229_create_families_and_contestants extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%users_families}}', [
            'id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER . "(11) NOT NULL",
            'status' => Schema::TYPE_STRING . "(50) NOT NULL",
            'created_at' => Schema::TYPE_DATETIME . " NOT NULL",
        ], $this->tableOptions);


        $this->createTable('{{%contestants}}', [
            'id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER . "(11) NOT NULL",
            'first_name' => Schema::TYPE_STRING . "(100) NOT NULL",
            'last_name' => Schema::TYPE_STRING . "(100) NOT NULL",
            'date_of_birth' => Schema::TYPE_DATE . " NOT NULL",
            'gender' => Schema::TYPE_SMALLINT. "(2) NOT NULL",
            't_shirt_size' => Schema::TYPE_SMALLINT. "(4) NOT NULL",
            'version' => Schema::TYPE_SMALLINT. "(4) NOT NULL",
        ], $this->tableOptions);

        $this->addForeignKey('fk_family_user_id_user_id', '{{%users_families}}', 'user_id', '{{%users_id}}', 'dynamic_id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_contestants_parent_users_families', '{{%contestants}}', 'user_id', '{{%users_families}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('{{%contestants}}');
        $this->dropTable('{{%users_families}}');
    }
}
