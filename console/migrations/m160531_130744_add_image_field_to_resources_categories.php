<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160531_130744_add_image_field_to_resources_categories extends Migration
{
    public function up()
    {
        $this->addColumn('{{%resources_categories}}', 'image', 'varchar(200)');
    }

    public function down()
    {
        $this->dropColumn('{{%resources_categories}}', 'image');
    }
}
