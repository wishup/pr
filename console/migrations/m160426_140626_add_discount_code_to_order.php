<?php

use yii\db\Migration;

class m160426_140626_add_discount_code_to_order extends Migration
{
    public function up()
    {
        $this->addColumn('{{%order}}', 'discount_code', 'varchar(50) NULL');
    }

    public function down()
    {
        $this->dropColumn('{{%order}}', 'discount_code');
    }
}
