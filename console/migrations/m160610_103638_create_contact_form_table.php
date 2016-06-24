<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

/**
 * Handles the creation for table `contact_form_table`.
 */
class m160610_103638_create_contact_form_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        // contact_form
        $this->createTable('{{%contact_form}}', [
            'id' => Schema::TYPE_PK,
            'first_name' => Schema::TYPE_STRING . "(150) NULL",
            'last_name' => Schema::TYPE_STRING . "(150) NULL",
            'subject' => Schema::TYPE_STRING . "(150) NULL",
            'email' => Schema::TYPE_STRING . "(150) NULL",
            'message' => Schema::TYPE_TEXT . " NULL",
            'date' => Schema::TYPE_DATETIME . " NULL",
        ], $this->tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%contact_form}}');
    }
}
