<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160209_115448_add_type_to_widgets_in_layouts extends Migration
{
    public function safeUp()
    {
		$this->addColumn('widgets_in_layouts', 'type', $this->string(30));
    }

    public function safeDown()
    {
		$this->dropColumn('widgets_in_layouts', 'type');
    }
}
