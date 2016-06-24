<?php
use yii\db\Schema;
use jamband\schemadump\Migration;

class m160418_101244_add_customer_service_status_to_users extends Migration
{
    public function up()
    {
        $this->addColumn('{{%users}}','cs_status', Schema::TYPE_SMALLINT.'(2) NOT NULL DEFAULT 0');

    }

    public function down()
    {
        $this->dropColumn('{{%users}}','cs_status');
    }
}
