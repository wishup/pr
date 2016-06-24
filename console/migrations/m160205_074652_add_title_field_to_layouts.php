<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160205_074652_add_title_field_to_layouts extends Migration
{
    public function safeUp()
    {
		$this->addColumn('layouts', 'title', $this->string(300));
    }

    public function safeDown()
    {
		$this->dropColumn('layouts', 'title');
    }
}
