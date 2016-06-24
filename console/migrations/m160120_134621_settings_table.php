<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160120_134621_settings_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%settings}}', [
            'id' => Schema::TYPE_PK,
            'facebook_api_key' => Schema::TYPE_STRING . "(100) NULL",
            'facebook_api_secret_key' => Schema::TYPE_STRING . "(100) NULL",
            'facebook_link' => Schema::TYPE_STRING . "(100) NULL",
            'twitter_link' => Schema::TYPE_STRING . "(100) NULL",
            'footer_copyrights' => Schema::TYPE_TEXT . " NULL",
        ], $this->tableOptions);
		
		$this->insert('{{%settings}}', [
            "id" => "1",
            "facebook_api_key" => '',
            "facebook_api_secret_key" => '',
            "facebook_link"=>'',
            "twitter_link"=>'',
            "footer_copyrights"=> '',
        ]);

    }

    public function safeDown()
    {
        $this->dropTable('{{%settings}}');
    }
}
