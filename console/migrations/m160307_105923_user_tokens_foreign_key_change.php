<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160307_105923_user_tokens_foreign_key_change extends Migration
{
    public function safeUp()
    {
		$this->dropForeignKey('fk_users_tokens_user_id', '{{%users_tokens}}');
		$this->addForeignKey('fk_users_tokens_user_id', '{{%users_tokens}}', 'user_id', '{{%users}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
    }
}
