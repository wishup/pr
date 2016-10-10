<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

/**
 * Handles the creation for table `posts_table`.
 */
class m161010_140211_create_posts_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        // posts
        $this->createTable('{{%posts}}', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . "(300) NULL",
            'short_content' => Schema::TYPE_TEXT . " NULL",
            'content' => Schema::TYPE_TEXT . " NULL",
            'date' => Schema::TYPE_DATETIME . " NULL",
            'image' => Schema::TYPE_STRING . "(300) NULL",
        ], $this->tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('posts');
    }
}
