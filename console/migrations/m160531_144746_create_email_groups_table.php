<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160531_144746_create_email_groups_table extends Migration
{
    public function up()
    {
        // email_groups
        $this->createTable('{{%email_groups}}', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . "(200) NULL",
            'description' => Schema::TYPE_TEXT . " NULL",
            'unsubscribe' => Schema::TYPE_INTEGER . "(1) NULL",
        ], $this->tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%email_groups}}');
    }
}
