<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160216_071747_create_options_table extends Migration
{
    public function up()
    {
        // options
		$this->createTable('{{%options}}', [
			'id' => Schema::TYPE_PK,
			'model' => Schema::TYPE_STRING . "(150) NOT NULL",
			'model_id' => Schema::TYPE_INTEGER . "(11) NOT NULL",
			'key' => Schema::TYPE_STRING . "(300) NULL",
			'value' => Schema::TYPE_TEXT . " NULL",
		], $this->tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%options}}');
    }
}
