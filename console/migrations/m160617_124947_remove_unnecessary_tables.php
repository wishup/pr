<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160617_124947_remove_unnecessary_tables extends Migration
{
    public function safeUp()
    {
        $this->dropTable('{{%family_host_history}}');
        $this->dropTable('{{%family_host}}');
        $this->dropTable('{{%order_item}}');
        $this->dropTable('{{%contestants_winners}}');
        $this->dropTable('{{%contestants}}');
        $this->dropTable('{{%order}}');


        $this->dropTable('{{%users_families}}');
        $this->dropTable('{{%users_hosts}}');
        $this->dropTable('{{%user_check}}');
        $this->dropTable('{{%user_info}}');
        $this->dropTable('{{%user_profile_history}}');
        $this->dropTable('{{%users_id}}');
        $this->dropTable('{{%users_emails}}');
        $this->dropTable('{{%users_notes}}');
        $this->dropTable('{{%users_tokens}}');
        $this->dropTable('{{%messaging_users}}');
        $this->dropTable('{{%mailing_users}}');
        $this->dropTable('{{%social_auth}}');
        $this->dropTable('{{%subscription}}');
        $this->dropTable('{{%users}}');
        $this->dropTable('{{%seasons}}');
        $this->dropTable('{{%hear_about}}');

        // users
        $this->createTable('{{%users}}', [
            'id' => Schema::TYPE_PK,
            'email' => Schema::TYPE_STRING . "(255) NOT NULL",
            'password' => Schema::TYPE_STRING . "(100) NOT NULL",
            'created_at' => Schema::TYPE_DATETIME . " NOT NULL",
            'updated_at' => Schema::TYPE_DATETIME . " NOT NULL",
            'status' => Schema::TYPE_INTEGER . "(1) NOT NULL",
        ], $this->tableOptions);

        $this->createTable('{{%users_tokens}}', [
            'id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER . "(11) NULL",
            'token' => Schema::TYPE_STRING . "(100) NULL",
            'slug' => Schema::TYPE_STRING . "(50) NULL",
        ], $this->tableOptions);

        // fk: users_tokens
        $this->addForeignKey('fk_users_tokens_user_id', '{{%users_tokens}}', 'user_id', '{{%users}}', 'id');

        // mailing_users
        $this->createTable('{{%mailing_users}}', [
            'id' => Schema::TYPE_PK,
            'mailing_id' => Schema::TYPE_INTEGER . "(11) NULL",
            'user_id' => Schema::TYPE_INTEGER . "(11) NULL",
            'sent' => Schema::TYPE_INTEGER . "(1) NULL",
            'sent_date' => Schema::TYPE_DATETIME . " NULL",
        ], $this->tableOptions);

        // fk: mailing_users
        $this->addForeignKey('fk_mailing_users_user_id', '{{%mailing_users}}', 'user_id', '{{%users}}', 'id', 'CASCADE', 'CASCADE');

        $this->insert('{{%help}}', [
            "id" => "1",
            "content" => '',
        ]);

        $this->insert('{{%widgets}}', [
            "id" => "1",
            "title" => 'Header',
            "slug" => 'header',
            "description" => '',
        ]);

        $this->insert('{{%widgets}}', [
            "id" => "2",
            "title" => 'Footer',
            "slug" => 'footer',
            "description" => '',
        ]);

        $this->insert('{{%widgets}}', [
            "id" => "3",
            "title" => 'Banner',
            "slug" => 'banner',
            "description" => '',
        ]);

        $this->insert('{{%widgets}}', [
            "id" => "4",
            "title" => 'Text block',
            "slug" => 'textblock',
            "description" => '',
        ]);

        $this->insert('{{%widgets}}', [
            "id" => "5",
            "title" => 'Banner with text',
            "slug" => 'banner_with_text',
            "description" => '',
        ]);

        $this->insert('{{%widgets}}', [
            "id" => "6",
            "title" => 'Newsletter',
            "slug" => 'newsletter',
            "description" => '',
        ]);

        $this->insert('{{%widgets}}', [
            "id" => "7",
            "title" => 'Social Networks Share',
            "slug" => 'social',
            "description" => '',
        ]);

        $this->insert('{{%widgets}}', [
            "id" => "8",
            "title" => 'Main content',
            "slug" => 'maincontent',
            "description" => '',
        ]);

        $this->insert('{{%widgets}}', [
            "id" => "9",
            "title" => 'Slider',
            "slug" => 'slider',
            "description" => '',
        ]);

        $this->insert('{{%widgets}}', [
            "id" => "10",
            "title" => 'Contact form',
            "slug" => 'contact',
            "description" => '',
        ]);

        $this->insert('{{%widgets}}', [
            "id" => "11",
            "title" => 'Get started',
            "slug" => 'getstarted',
            "description" => '',
        ]);

        $this->insert('{{%widgets}}', [
            "id" => "12",
            "title" => 'Communication centre messages',
            "slug" => 'adminmessages',
            "description" => '',
        ]);
    }

    public function safeDown()
    {
    }
}
