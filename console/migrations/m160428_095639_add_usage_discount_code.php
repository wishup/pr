<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160428_095639_add_usage_discount_code extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%discount}}', 'usage', 'INT(6) NOT NULL DEFAULT 0');
    }

    public function safeDown()
    {
        $this->dropColumn('{{%discount}}', 'usage');
    }
}
