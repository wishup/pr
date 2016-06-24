<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160310_145101_order_to_slides extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%slides}}', 'order', $this->integer(11));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%slides}}', 'order');
    }
}
