<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160229_112408_new_table_sliders extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%sliders}}', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . "(300) NOT NULL",
        ], $this->tableOptions);

        $this->createTable('{{%slides}}', [
            'id' => Schema::TYPE_PK,
            'slider_id' => Schema::TYPE_INTEGER . "(11) NOT NULL",
            'slide' => Schema::TYPE_STRING . "(100) NOT NULL",
        ], $this->tableOptions);

        $this->addForeignKey('fk_slides_slider_id', '{{%slides}}', 'slider_id', '{{%sliders}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_slides_slider_id', '{{%slides}}');
        $this->dropTable('{{%slides}}');
        $this->dropTable('{{%sliders}}');
    }
}
