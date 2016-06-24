<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160407_122801_add_status_to_children extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%contestants}}', 'status', Schema::TYPE_BOOLEAN ." NOT NULL DEFAULT FALSE");

    }

    public function safeDown()
    {

        $this->dropColumn('{{%contestants}}', 'status' );
    }
}
