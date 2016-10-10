<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

/**
 * Handles the creation for table `gallery_tables`.
 */
class m161010_084635_create_gallery_tables extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        // gallery
        $this->createTable('{{%gallery}}', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . "(300) NULL",
            'description' => Schema::TYPE_TEXT . " NULL",
        ], $this->tableOptions);

        // gallery_item
        $this->createTable('{{%gallery_item}}', [
            'id' => Schema::TYPE_PK,
            'gallery_id' => Schema::TYPE_INTEGER . "(11) NULL",
            'name' => Schema::TYPE_STRING . "(300) NULL",
            'description' => Schema::TYPE_TEXT . " NULL",
            'image' => Schema::TYPE_STRING . "(300) NULL",
        ], $this->tableOptions);

        // fk: gallery_item
        $this->addForeignKey('fk_gallery_item_gallery_id', '{{%gallery_item}}', 'gallery_id', '{{%gallery}}', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('gallery_item');
        $this->dropTable('gallery');
    }
}
