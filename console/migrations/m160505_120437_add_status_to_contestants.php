<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160505_120437_add_status_to_contestants extends Migration
{
    public function up()
    {
		$this->addColumn('{{%contestants}}', 'status', Schema::TYPE_INTEGER ."(1) NOT NULL DEFAULT 0");
    }

    public function down()
    {
		$this->dropColumn('{{%contestants}}', 'status' );
    }
}
