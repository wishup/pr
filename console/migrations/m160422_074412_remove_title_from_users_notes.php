<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160422_074412_remove_title_from_users_notes extends Migration
{
    public function safeUp()
    {
        $this->dropColumn('users_notes', 'title');
    }

    public function safeDown()
    {
        $this->addColumn('users_notes', 'title', 'VARCHAR(255) NOT NULL');
    }
}
