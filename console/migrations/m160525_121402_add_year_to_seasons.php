<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160525_121402_add_year_to_seasons extends Migration
{
    public function up()
    {
        $this->addColumn('{{%seasons}}', 'year', 'varchar(4)');
    }

    public function down()
    {
        $this->dropColumn('{{%seasons}}', 'year');
    }
}
