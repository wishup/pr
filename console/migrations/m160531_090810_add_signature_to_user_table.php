<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160531_090810_add_signature_to_user_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user_info_backend}}', 'signature', 'longtext');
    }

    public function down()
    {
        $this->dropColumn('{{%user_info_backend}}', 'signature');
    }
}
