<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160526_135218_add_migr_table_field_to_users extends Migration
{
    public function up()
    {
        $this->addColumn('{{%users}}', 'migr_table', 'varchar(50)');
    }

    public function down()
    {
        $this->dropColumn('{{%users}}', 'migr_table');
    }
}
