<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160222_073421_create_mailing_templates_table extends Migration
{
    public function up()
    {
        // mailing_templates
		$this->createTable('{{%mailing_templates}}', [
			'id' => Schema::TYPE_PK,
			'title' => Schema::TYPE_STRING . "(200) NULL",
			'message' => Schema::TYPE_TEXT . " NULL",
		], $this->tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%mailing_templates}}');
    }
}
