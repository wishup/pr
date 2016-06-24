<?php

use yii\db\Migration;

class m160502_104307_create_subscription extends Migration
{
    public function up()
    {
        $this->createTable('subscription', [
            'id' => $this->primaryKey(),
            'subscription_id' => "INT(11) NOT NULL",
            'user_id' => "INT(11) NOT NULL",
            'amount' => "DECIMAL(11,2) NOT NULL",
            'status' => "TINYINT(1) NOT NULL DEFAULT 0",
            'created' => "TIMESTAMP NOT NULL",
            'updated' => "TIMESTAMP NOT NULL",
        ]);
    }

    public function down()
    {
        $this->dropTable('subscription');
    }
}
