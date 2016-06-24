<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160419_081613_add_all_csstatuses_to_users extends Migration
{
    public function safeUp()
    {
        $this->dropColumn('{{%users}}', 'cs_status');
        $this->dropColumn('{{%users_hosts}}', 'cs_status');
        $this->dropColumn('{{%users_families}}', 'cs_status');


        $this->addColumn('{{%users}}','h_cs_status', Schema::TYPE_SMALLINT.'(2) NOT NULL DEFAULT 0');
        $this->addColumn('{{%users}}','f_cs_status', Schema::TYPE_SMALLINT.'(2) NOT NULL DEFAULT 0');
        $this->addColumn('{{%users}}','v_cs_status', Schema::TYPE_SMALLINT.'(2) NOT NULL DEFAULT 0');
        $this->addColumn('{{%users}}','n_cs_status', Schema::TYPE_SMALLINT.'(2) NOT NULL DEFAULT 0');


    }

    public function safeDown()
    {
        $this->dropColumn('{{%users}}', 'h_cs_status');
        $this->dropColumn('{{%users}}', 'f_cs_status');
        $this->dropColumn('{{%users}}', 'v_cs_status');
        $this->dropColumn('{{%users}}', 'n_cs_status');

        $this->addColumn('{{%users}}','cs_status', Schema::TYPE_SMALLINT.'(2) NOT NULL DEFAULT 0');
        $this->addColumn('{{%users_hosts}}','cs_status', Schema::TYPE_SMALLINT.'(2) NOT NULL DEFAULT 0');
        $this->addColumn('{{%users_families}}','cs_status', Schema::TYPE_SMALLINT.'(2) NOT NULL DEFAULT 0');

    }
}
