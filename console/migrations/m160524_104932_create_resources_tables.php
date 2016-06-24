<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160524_104932_create_resources_tables extends Migration
{
    public function up()
    {
        // resources
        $this->createTable('{{%resources}}', [
            'id' => Schema::TYPE_PK,
            'category_id' => Schema::TYPE_INTEGER . "(11) NULL",
            'age_group' => Schema::TYPE_STRING . "(50) NULL",
            'version' => Schema::TYPE_INTEGER . "(11) NULL",
            'overlay_text' => Schema::TYPE_STRING . "(300) NULL",
            'thumbnail' => Schema::TYPE_STRING . "(300) NULL",
            'file' => Schema::TYPE_STRING . "(300) NULL",
        ], $this->tableOptions);

        // resources_categories
        $this->createTable('{{%resources_categories}}', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . "(200) NULL",
            'subtitle' => Schema::TYPE_STRING . "(200) NULL",
        ], $this->tableOptions);

        // fk: resources
        $this->addForeignKey('fk_resources_category_id', '{{%resources}}', 'category_id', '{{%resources_categories}}', 'id', 'CASCADE', 'CASCADE');

    }

    public function down()
    {
        $this->dropTable('{{%resources}}');
        $this->dropTable('{{%resources_categories}}');
    }
}
