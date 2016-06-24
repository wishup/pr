<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160112_145243_alter_date_of_birth_column extends Migration
{
    public function safeUp()
    {
		$this->alterColumn('{{%user_info}}', 'date_of_birth', Schema::TYPE_DATE . " NULL" );
    }

    public function safeDown()
    {
    }
}
