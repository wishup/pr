<?php

use yii\db\Migration;

class m160330_153703_add_agegroup_to_childs extends Migration
{
    public function up()
    {
        $this->addColumn('{{%contestants}}', 'age_group', $this->string(200));
    }

    public function down()
    {
        $this->dropColumn('{{%contestants}}', 'age_group');
    }
}
