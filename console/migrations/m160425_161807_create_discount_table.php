<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160425_161807_create_discount_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%discount}}', [
			'id' => Schema::TYPE_PK,
			'title' => Schema::TYPE_STRING . "(100) NULL",
			'code' => Schema::TYPE_STRING . "(20) NULL",
			'discount_type' => Schema::TYPE_STRING . "(20) NULL",
			'amount' => Schema::TYPE_FLOAT . " NULL",
			'limit' => Schema::TYPE_INTEGER . "(11) NULL",
			'limit_per_user' => Schema::TYPE_INTEGER . "(11) NULL",
			'only_model' => Schema::TYPE_STRING . "(100) NULL",
			'only_model_id' => Schema::TYPE_INTEGER . "(11) NULL",
		], $this->tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%discount}}');
    }
}
