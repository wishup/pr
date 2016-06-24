<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160401_133906_add_journal_field_into_child extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%contestants}}', 'journal', Schema::TYPE_BOOLEAN ." NOT NULL DEFAULT FALSE");

    }

    public function safeDown()
    {

        $this->dropColumn('{{%contestants}}', 'journal' );
    }
}
