<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160601_081128_alter_resources_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%resources}}', 'button_type', 'varchar(30)');
        $this->addColumn('{{%resources}}', 'url', 'varchar(200)');
    }

    public function safeDown()
    {
        $this->dropColumn('{{%resources}}', 'button_type');
        $this->dropColumn('{{%resources}}', 'url');
    }
}
