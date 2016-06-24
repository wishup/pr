<?php

use yii\db\Migration;

class m160422_083204_add_slug_to_emailtemplate extends Migration
{
    public function up()
    {
        $this->addColumn('emailtemplates', 'slug', 'VARCHAR(50) NOT NULL');
    }

    public function down()
    {
        $this->dropColumn('emailtemplates', 'slug');
    }
}
