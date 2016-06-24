<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160606_112927_add_date_field_in_family_host_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%family_host}}', 'date', 'datetime');
        $this->addColumn('{{%family_host}}', 'history', 'text');
    }

    public function safeDown()
    {
        $this->dropColumn('{{%family_host}}', 'date');
        $this->dropColumn('{{%family_host}}', 'history');
    }
}
