<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160420_080415_add_status_to_email_templates extends Migration
{
    public function up()
    {
        $this->addColumn('{{%emailtemplates}}', 'status', Schema::TYPE_SMALLINT . '(2) NOT NULL DEFAULT 1');
    }

    public function down()
    {
        $this->dropColumn('{{%emailtemplates}}', 'status');
    }
}
