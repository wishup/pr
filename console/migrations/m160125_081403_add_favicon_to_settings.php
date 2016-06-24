<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160125_081403_add_favicon_to_settings extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%settings}}', 'favicon', $this->string(100));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%settings}}', 'favicon');
    }
}
