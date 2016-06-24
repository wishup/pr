<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160406_113802_add_spouse_to_family extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%users_families}}', 'spouse_first_name', Schema::TYPE_STRING ."(100) NOT NULL");
        $this->addColumn('{{%users_families}}', 'spouse_last_name', Schema::TYPE_STRING ."(100) NOT NULL");

    }

    public function safeDown()
    {

        $this->dropColumn('{{%users_families}}', 'spouse_first_name' );
        $this->dropColumn('{{%users_families}}', 'spouse_last_name' );
    }
}
