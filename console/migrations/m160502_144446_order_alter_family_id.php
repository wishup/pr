<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160502_144446_order_alter_family_id extends Migration
{
    public function safeUp()
    {
        $this->alterColumn('{{%order}}', 'user_id', 'INT(11) NULL');
    }

    public function safeDown()
    {
        $this->alterColumn('{{%order}}', 'user_id', 'INT(11) NOT NULL');
    }
}
