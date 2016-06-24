<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160311_091526_add_link_to_slides extends Migration
{
    public function up()
    {
        $this->addColumn('{{%slides}}', 'link', $this->string(100));
    }

    public function down()
    {
        $this->dropColumn('{{%slides}}', 'link');
    }
}
