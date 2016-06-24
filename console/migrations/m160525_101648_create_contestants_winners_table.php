<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160525_101648_create_contestants_winners_table extends Migration
{
    public function up()
    {
        // contestants_winners
        $this->createTable('{{%contestants_winners}}', [
            'id' => Schema::TYPE_PK,
            'contestant_id' => Schema::TYPE_INTEGER . "(11) NULL",
            'year' => Schema::TYPE_STRING . "(4) NULL",
        ], $this->tableOptions);

        // fk: contestants_winners
        $this->addForeignKey('fk_contestants_winners_contestant_id', '{{%contestants_winners}}', 'contestant_id', '{{%contestants}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%contestants_winners}}');
    }
}
