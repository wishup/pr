<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160406_113848_add_cell_phone_to_usersinfo extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%user_info}}', 'cell_phone', Schema::TYPE_STRING . "(50) NOT NULL");

    }

    public function safeDown()
    {

        $this->dropColumn('{{%user_info}}', 'cell_phone' );
    }
}
