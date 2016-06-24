<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

/**
 * Handles the creation for table `family_host_history_table`.
 */
class m160614_125057_create_family_host_history_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        // family_host_history
        $this->createTable('{{%family_host_history}}', [
            'id' => Schema::TYPE_PK,
            'family_id' => Schema::TYPE_INTEGER . "(11) NULL",
            'host_id' => Schema::TYPE_INTEGER . "(11) NULL",
            'date' => Schema::TYPE_DATETIME . " NULL",
        ], $this->tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%family_host_history}}');
    }
}
