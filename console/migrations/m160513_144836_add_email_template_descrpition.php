<?php

use yii\db\Migration;

class m160513_144836_add_email_template_descrpition extends Migration
{
    public function up()
    {
        $this->addColumn('emailtemplates', 'description', 'TEXT NULL');
    }

    public function down()
    {
        $this->dropColumn('emailtemplates', 'description');
    }
}
