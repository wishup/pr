<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160209_071900_add_active_field_to_layout_widgets extends Migration
{
    public function safeUp()
    {
		$this->addColumn('widgets_in_layouts', 'active', $this->integer(1));
    }

    public function safeDown()
    {
		$this->dropColumn('widgets_in_layouts', 'active');
    }
}
