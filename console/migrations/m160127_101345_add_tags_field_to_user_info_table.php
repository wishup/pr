<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160127_101345_add_tags_field_to_user_info_table extends Migration
{
    public function safeUp()
    {
		$this->addColumn('{{%user_info}}', 'tags', Schema::TYPE_TEXT." NULL");
    }

    public function safeDown()
    {
		$this->dropColumn('{{%user_info}}', 'tags');
    }
}
