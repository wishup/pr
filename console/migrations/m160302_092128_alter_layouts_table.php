<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160302_092128_alter_layouts_table extends Migration
{
    public function safeUp()
    {
		$this->addColumn('{{%layouts}}', 'layout_file', $this->string(50));
    }

    public function safeDown()
    {
		$this->dropColumn('{{%layouts}}', 'layout_file');
    }
}
