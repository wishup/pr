<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160120_140130_add_acronim_to_glossary extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%glossary}}', 'acronim', $this->string(100));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%glossary}}', 'acronym');
    }
}
