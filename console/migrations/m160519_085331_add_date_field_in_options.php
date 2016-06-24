<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160519_085331_add_date_field_in_options extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%options}}', 'date', 'datetime NULL');
    }

    public function safeDown()
    {
        $this->dropColumn('{{%options}}', 'date');
    }
}
