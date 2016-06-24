<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160413_135842_add_created_at_to_contestants_and_order extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%contestants}}', 'created_at', Schema::TYPE_TIMESTAMP . " NOT NULL");
        $this->addColumn('{{%order}}', 'created_at', Schema::TYPE_TIMESTAMP . " NOT NULL");

    }

    public function safeDown()
    {

        $this->dropColumn('{{%contestants}}', 'created_at' );
        $this->dropColumn('{{%order}}', 'created_at' );
    }
}
