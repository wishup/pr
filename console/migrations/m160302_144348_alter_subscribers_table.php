<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160302_144348_alter_subscribers_table extends Migration
{
    public function safeUp()
    {
		$this->addColumn('{{%subscribers}}', 'slug', $this->string(50));
		$this->addColumn('{{%subscribers}}', 'info', $this->text());
    }

    public function safeDown()
    {
		$this->dropColumn('{{%subscribers}}', 'slug');
		$this->dropColumn('{{%subscribers}}', 'info');
    }
}
