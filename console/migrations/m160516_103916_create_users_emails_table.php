<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160516_103916_create_users_emails_table extends Migration
{
    public function up()
    {
        // users_emails
        $this->createTable('{{%users_emails}}', [
            'id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER . "(11) NULL",
            'email' => Schema::TYPE_STRING . "(100) NULL",
        ], $this->tableOptions);

        // fk: users_emails
        $this->addForeignKey('fk_users_emails_user_id', '{{%users_emails}}', 'user_id', '{{%users}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%users_emails}}');
    }
}
