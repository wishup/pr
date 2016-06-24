<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160112_140450_user_info_backend extends Migration
{
    public function up()
    {
        $this->createTable('{{%user_info_backend}}', [
            'id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER . "(11) NULL",
            'first_name' => Schema::TYPE_STRING . "(100) NULL",
            'last_name' => Schema::TYPE_STRING . "(100) NULL",
            'last_login' => Schema::TYPE_DATETIME . " NULL",
        ], $this->tableOptions);

        $this->addForeignKey('fk_user_info_backend_user_id', '{{%user_info_backend}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');

        $this->insert('{{%user_info_backend}}', [
            "id" => "1",
            "user_id" => '1',
            "first_name" => '',
            "last_name" => '',
            "last_login" => '2016-06-01 00:00:00',
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%user_info_backend}}');
    }
}
