<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160601_131307_add_group_id_to_emailtemplates extends Migration
{
    public function up()
    {
        $this->addColumn('{{%emailtemplates}}', 'group_id', 'int(11)');
    }

    public function down()
    {
        $this->dropColumn('{{%emailtemplates}}', 'group_id');
    }
}
