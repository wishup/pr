<?php

use yii\db\Migration;

class m160517_072435_add_type_to_user_history extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user_profile_history}}', 'type', 'VARCHAR(50) NOT NULL');
    }

    public function down()
    {
        $this->dropColumn('{{%user_profile_history}}', 'type');
    }
}
