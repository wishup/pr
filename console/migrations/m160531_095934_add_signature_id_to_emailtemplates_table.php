<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160531_095934_add_signature_id_to_emailtemplates_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%emailtemplates}}', 'signature_id', 'int(11)');
    }

    public function down()
    {
        $this->dropColumn('{{%emailtemplates}}', 'signature_id');
    }
}
