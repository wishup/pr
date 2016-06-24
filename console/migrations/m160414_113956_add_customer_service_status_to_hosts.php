<?php


use yii\db\Schema;
use jamband\schemadump\Migration;

class m160414_113956_add_customer_service_status_to_hosts extends Migration
{
    public function up()
    {
        $this->addColumn('{{%users_hosts}}','cs_status', Schema::TYPE_SMALLINT.'(2) NOT NULL DEFAULT 0');

    }

    public function down()
    {
        $this->dropColumn('{{%users_hosts}}','cs_status');
    }
}
