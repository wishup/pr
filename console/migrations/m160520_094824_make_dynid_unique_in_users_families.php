<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160520_094824_make_dynid_unique_in_users_families extends Migration
{
    public function safeUp()
    {
        $this->createIndex('unique_dyn_id_users_families', 'users_families', 'user_id', True);
    }

    public function safeDown()
    {
        $this->dropIndex('unique_dyn_id_users_families', 'users_families');
    }
}
