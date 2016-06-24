<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160229_131517_create_live_edit_table extends Migration
{
    public function up()
    {
        // live_edit
		$this->createTable('{{%live_edit}}', [
			'id' => Schema::TYPE_PK,
			'token' => Schema::TYPE_STRING . "(100) NULL",
			'date' => Schema::TYPE_DATETIME . " NULL",
			'model' => Schema::TYPE_STRING . "(100) NULL",
			'model_id' => Schema::TYPE_INTEGER . "(11) NULL",
			'field' => Schema::TYPE_STRING . "(100) NULL",
			'encoded' => Schema::TYPE_STRING . "(100) NULL",
			'index' => Schema::TYPE_STRING . "(100) NULL",
		], $this->tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%live_edit}}');
    }
}
