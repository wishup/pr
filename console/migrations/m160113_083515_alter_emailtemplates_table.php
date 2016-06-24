<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160113_083515_alter_emailtemplates_table extends Migration
{
    public function safeUp()
    {
		$this->addColumn('{{%emailtemplates}}', 'layout_id', Schema::TYPE_INTEGER." NULL");
    }

    public function safeDown()
    {
		$this->dropColumn('{{%emailtemplates}}', 'layout_id');
    }
}
