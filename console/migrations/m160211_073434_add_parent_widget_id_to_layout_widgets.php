<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160211_073434_add_parent_widget_id_to_layout_widgets extends Migration
{
    public function safeUp()
    {
		$this->addColumn('widgets_in_layouts', 'parent_widget_id', $this->integer(11)." NOT NULL");
    }

    public function safeDown()
    {
		$this->dropColumn('widgets_in_layouts', 'parent_widget_id');
    }
}
