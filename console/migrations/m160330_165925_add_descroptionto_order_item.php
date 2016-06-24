<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160330_165925_add_descroptionto_order_item extends Migration
{
    public function up()
    {
		$this->addColumn('{{%order_item}}', 'description', $this->string(300));
    }

    public function down()
    {
		$this->dropColumn('{{%order_item}}', 'description');
    }
}
