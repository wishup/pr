<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

/**
 * Handles adding fields to table `subscribers`.
 */
class m160615_074245_add_fields_to_subscribers extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('{{%subscribers}}', 'first_name', 'varchar(100)');
        $this->addColumn('{{%subscribers}}', 'last_name', 'varchar(100)');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('{{%subscribers}}', 'first_name');
        $this->dropColumn('{{%subscribers}}', 'last_name');
    }
}
