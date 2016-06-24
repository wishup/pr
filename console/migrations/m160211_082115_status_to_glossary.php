<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160211_082115_status_to_glossary extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%glossary}}', 'status', $this->string(30));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%glossary}}', 'status');
    }
}
