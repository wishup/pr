<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160111_122005_add_latitude_longitutde_to_users_hosts extends Migration
{
    public function up()
    {
        $this->addColumn('users_hosts', 'latitude', $this->string(100));
        $this->addColumn('users_hosts', 'longitude', $this->string(100));
    }

    public function down()
    {
        $this->dropColumn('users_hosts', 'latitude');
        $this->dropColumn('users_hosts', 'longitude');
    }
}
