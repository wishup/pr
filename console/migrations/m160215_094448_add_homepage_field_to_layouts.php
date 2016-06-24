<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160215_094448_add_homepage_field_to_layouts extends Migration
{
    public function safeUp()
    {
		$this->addColumn('{{%layouts}}', 'homepage', $this->integer(1));
    }

    public function safeDown()
    {
		$this->dropColumn('{{%layouts}}', 'homepage');
    }
}
