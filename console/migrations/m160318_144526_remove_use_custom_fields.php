<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160318_144526_remove_use_custom_fields extends Migration
{
    public function safeUp()
    {
        $this->dropColumn('{{%user_check}}', 'use_custom_fields');
    }

    public function safeDown()
    {

        $this->addColumn('{{%user_check}}', 'use_custom_fields', Schema::TYPE_INTEGER . "(1) NOT NULL");
    }
}
