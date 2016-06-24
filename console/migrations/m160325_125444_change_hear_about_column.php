<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160325_125444_change_hear_about_column extends Migration
{
    public function safeUp()
    {
        $this->alterColumn('{{%user_info}}','hear_about_us','integer');
    }

    public function safeDown()
    {
        $this->alterColumn('{{%user_info}}','hear_about_us','string');
    }
}
