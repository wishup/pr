<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160314_122051_alter_user_info_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%user_info}}', 'hear_about_us', $this->string(200));
        $this->addColumn('{{%user_info}}', 'hear_about_us_other', $this->string(300));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%user_info}}', 'hear_about_us');
        $this->dropColumn('{{%user_info}}', 'hear_about_us_other');
    }
}
