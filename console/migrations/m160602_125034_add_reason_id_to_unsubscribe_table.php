<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160602_125034_add_reason_id_to_unsubscribe_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%unsubscribe}}', 'reason_id', 'int(11)');
    }

    public function down()
    {
        $this->dropColumn('{{%unsubscribe}}', 'reason_id');
    }
}
