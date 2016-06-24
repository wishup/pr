<?php

use yii\db\Migration;

class m160429_080155_add_per_type_to_discount_code extends Migration
{
    public function up()
    {
        $this->addColumn('{{%discount}}', 'per_type', 'TINYINT(1) NOT NULL DEFAULT 0');
    }

    public function down()
    {
        $this->dropColumn('{{%discount}}', 'per_type');
    }
}
