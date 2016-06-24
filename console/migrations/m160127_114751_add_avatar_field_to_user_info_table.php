<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160127_114751_add_avatar_field_to_user_info_table extends Migration
{
    public function safeUp()
    {
		$this->addColumn('{{%user_info}}', 'avatar', Schema::TYPE_STRING."(200) NULL");
    }

    public function safeDown()
    {
		$this->dropColumn('{{%user_info}}', 'avatar');
    }
}
