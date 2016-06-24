<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m151124_141059_create_tables extends Migration
{
    public function safeUp()
    {

		// faq
		$this->createTable('{{%faq}}', [
			'id' => Schema::TYPE_PK,
			'question' => Schema::TYPE_TEXT . " NOT NULL",
			'answer' => Schema::TYPE_TEXT . " NOT NULL",
			'status' => Schema::TYPE_STRING . "(30) NOT NULL",
			'exclude_from_search' => Schema::TYPE_INTEGER . "(1) NOT NULL",
		], $this->tableOptions);

		// favorite_urls
		$this->createTable('{{%favorite_urls}}', [
			'id' => Schema::TYPE_PK,
			'user_id' => Schema::TYPE_INTEGER . "(11) NOT NULL",
			'title' => Schema::TYPE_STRING . "(300) NOT NULL",
			'url' => Schema::TYPE_STRING . "(300) NOT NULL",
		], $this->tableOptions);

		// glossary
		$this->createTable('{{%glossary}}', [
			'id' => Schema::TYPE_PK,
			'word' => Schema::TYPE_STRING . "(200) NOT NULL",
			'description' => Schema::TYPE_TEXT . " NOT NULL",
			'exclude_from_search' => Schema::TYPE_INTEGER . "(1) NOT NULL",
		], $this->tableOptions);

		// html_pages
		$this->createTable('{{%html_pages}}', [
			'id' => Schema::TYPE_PK,
			'title' => Schema::TYPE_STRING . "(100) NOT NULL",
			'content' => Schema::TYPE_TEXT . " NOT NULL",
		], $this->tableOptions);

		// layouts
		$this->createTable('{{%layouts}}', [
			'id' => Schema::TYPE_PK,
			'url' => Schema::TYPE_STRING . "(300) NOT NULL",
			'parent_id' => Schema::TYPE_INTEGER . "(11) NOT NULL",
		], $this->tableOptions);

		// layouts_settings
		$this->createTable('{{%layouts_settings}}', [
			'id' => Schema::TYPE_PK,
			'layout_id' => Schema::TYPE_INTEGER . "(11) NOT NULL",
			'key' => Schema::TYPE_STRING . "(100) NOT NULL",
			'value' => Schema::TYPE_STRING . "(100) NOT NULL",
		], $this->tableOptions);

		// layouts_widgets_areas
		$this->createTable('{{%layouts_widgets_areas}}', [
			'id' => Schema::TYPE_PK,
			'layout_id' => Schema::TYPE_INTEGER . "(11) NOT NULL",
			'section' => Schema::TYPE_STRING . "(50) NOT NULL",
			'widget_area_id' => Schema::TYPE_INTEGER . "(11) NOT NULL",
		], $this->tableOptions);

		// menu
		$this->createTable('{{%menu}}', [
			'id' => Schema::TYPE_PK,
			'title' => Schema::TYPE_STRING . "(100) NOT NULL",
		], $this->tableOptions);

		// menu_items
		$this->createTable('{{%menu_items}}', [
			'id' => Schema::TYPE_PK,
			'parent_id' => Schema::TYPE_INTEGER . "(11) NOT NULL",
			'menu_id' => Schema::TYPE_INTEGER . "(11) NOT NULL",
			'name' => Schema::TYPE_STRING . "(100) NOT NULL",
			'url' => Schema::TYPE_STRING . "(300) NOT NULL",
			'order' => Schema::TYPE_INTEGER . "(11) NOT NULL",
			'other_url' => Schema::TYPE_STRING . "(300) NOT NULL",
		], $this->tableOptions);

		// pages
		$this->createTable('{{%pages}}', [
			'id' => Schema::TYPE_PK,
			'type' => Schema::TYPE_INTEGER . "(1) NOT NULL",
			'name' => Schema::TYPE_STRING . "(300) NOT NULL",
			'header' => Schema::TYPE_STRING . "(300) NOT NULL",
			'content' => Schema::TYPE_TEXT . " NOT NULL",
			'html_page_id' => Schema::TYPE_INTEGER . "(11) NULL",
			'exclude_from_search' => Schema::TYPE_INTEGER . "(1) NOT NULL",
			'status' => Schema::TYPE_STRING . "(50) NOT NULL",
			'password' => Schema::TYPE_STRING . "(20) NULL",
		], $this->tableOptions);

		// pages_revisions
		$this->createTable('{{%pages_revisions}}', [
			'id' => Schema::TYPE_PK,
			'page_id' => Schema::TYPE_INTEGER . "(11) NOT NULL",
			'user_id' => Schema::TYPE_INTEGER . "(11) NOT NULL",
			'content' => Schema::TYPE_TEXT . " NOT NULL",
			'date' => Schema::TYPE_DATETIME . " NOT NULL",
			'action' => Schema::TYPE_STRING . "(50) NOT NULL",
		], $this->tableOptions);

		// recent_urls
		$this->createTable('{{%recent_urls}}', [
			'id' => Schema::TYPE_PK,
			'user_id' => Schema::TYPE_INTEGER . "(11) NOT NULL",
			'title' => Schema::TYPE_STRING . "(300) NOT NULL",
			'url' => Schema::TYPE_STRING . "(300) NOT NULL",
		], $this->tableOptions);

		// seasons
		$this->createTable('{{%seasons}}', [
			'id' => Schema::TYPE_PK,
			'title' => Schema::TYPE_STRING . "(100) NOT NULL",
			'active' => Schema::TYPE_INTEGER . "(1) NOT NULL",
		], $this->tableOptions);

		// seo_parameters
		$this->createTable('{{%seo_parameters}}', [
			'id' => Schema::TYPE_PK,
			'url' => Schema::TYPE_STRING . "(300) NOT NULL",
			'title' => Schema::TYPE_STRING . "(300) NOT NULL",
			'meta_description' => Schema::TYPE_TEXT . " NOT NULL",
			'meta_keywords' => Schema::TYPE_TEXT . " NOT NULL",
		], $this->tableOptions);

		// seo_settings
		$this->createTable('{{%seo_settings}}', [
			'id' => Schema::TYPE_PK,
			'default_url' => Schema::TYPE_STRING . "(300) NOT NULL",
			'rewrite_url' => Schema::TYPE_STRING . "(300) NOT NULL",
		], $this->tableOptions);

		// user_check
		$this->createTable('{{%user_check}}', [
			'id' => Schema::TYPE_PK,
			'user_id' => Schema::TYPE_INTEGER . "(11) NOT NULL",
			'status' => Schema::TYPE_STRING . "(30) NOT NULL",
			'TransactionID' => Schema::TYPE_STRING . "(50) NOT NULL",
			'use_custom_fields' => Schema::TYPE_INTEGER . "(1) NOT NULL",
			'ssn' => Schema::TYPE_STRING . "(100) NOT NULL",
			'first_name' => Schema::TYPE_STRING . "(100) NOT NULL",
			'last_name' => Schema::TYPE_STRING . "(100) NOT NULL",
			'middle_name' => Schema::TYPE_STRING . "(100) NOT NULL",
			'date_of_birth' => Schema::TYPE_DATE . " NOT NULL",
			'address_1' => Schema::TYPE_STRING . "(300) NOT NULL",
			'address_2' => Schema::TYPE_STRING . "(300) NOT NULL",
			'city' => Schema::TYPE_STRING . "(100) NOT NULL",
			'state' => Schema::TYPE_STRING . "(100) NOT NULL",
			'country' => Schema::TYPE_STRING . "(100) NOT NULL",
			'zip' => Schema::TYPE_STRING . "(100) NOT NULL",
			'email' => Schema::TYPE_STRING . "(100) NOT NULL",
		], $this->tableOptions);

		// user_info
		$this->createTable('{{%user_info}}', [
			'id' => Schema::TYPE_PK,
			'user_id' => Schema::TYPE_INTEGER . "(11) NOT NULL",
			'first_name' => Schema::TYPE_STRING . "(100) NOT NULL",
			'last_name' => Schema::TYPE_STRING . "(100) NOT NULL",
			'middle_name' => Schema::TYPE_STRING . "(100) NOT NULL",
			'address_1' => Schema::TYPE_STRING . "(300) NOT NULL",
			'address_2' => Schema::TYPE_STRING . "(300) NOT NULL",
			'country' => Schema::TYPE_STRING . "(100) NOT NULL",
			'city' => Schema::TYPE_STRING . "(100) NOT NULL",
			'state' => Schema::TYPE_STRING . "(100) NOT NULL",
			'zip' => Schema::TYPE_STRING . "(50) NOT NULL",
			'phone' => Schema::TYPE_STRING . "(50) NOT NULL",
			'date_of_birth' => Schema::TYPE_DATE . " NOT NULL",
			'ssn' => Schema::TYPE_STRING . "(50) NOT NULL",
		], $this->tableOptions);

		// user_profile_history
		$this->createTable('{{%user_profile_history}}', [
			'id' => Schema::TYPE_PK,
			'user_id' => Schema::TYPE_INTEGER . "(11) NOT NULL",
			'date' => Schema::TYPE_DATETIME . " NOT NULL",
			'fields' => Schema::TYPE_TEXT . " NOT NULL",
		], $this->tableOptions);

		// users
		$this->createTable('{{%users}}', [
			'id' => Schema::TYPE_PK,
			'email' => Schema::TYPE_STRING . "(255) NOT NULL",
			'password' => Schema::TYPE_STRING . "(100) NOT NULL",
			'created_at' => Schema::TYPE_DATETIME . " NOT NULL",
			'updated_at' => Schema::TYPE_DATETIME . " NOT NULL",
			'status' => Schema::TYPE_INTEGER . "(1) NOT NULL",
		], $this->tableOptions);

		// users_hosts
		$this->createTable('{{%users_hosts}}', [
			'id' => Schema::TYPE_PK,
			'user_id' => Schema::TYPE_INTEGER . "(11) NOT NULL",
			'status' => Schema::TYPE_STRING . "(50) NOT NULL",
			'created_at' => Schema::TYPE_DATETIME . " NOT NULL",
			'summer_event_info' => Schema::TYPE_STRING . "(300) NOT NULL",
			'summer_event_location' => Schema::TYPE_STRING . "(300) NOT NULL",
			'summer_event_address' => Schema::TYPE_STRING . "(300) NOT NULL",
			'summer_event_address_2' => Schema::TYPE_STRING . "(300) NOT NULL",
			'summer_event_city' => Schema::TYPE_STRING . "(100) NOT NULL",
			'summer_event_state' => Schema::TYPE_STRING . "(100) NOT NULL",
			'summer_event_zip' => Schema::TYPE_STRING . "(50) NOT NULL",
			'celeb_day_info' => Schema::TYPE_STRING . "(300) NOT NULL",
			'celeb_location' => Schema::TYPE_STRING . "(300) NOT NULL",
			'celeb_address' => Schema::TYPE_STRING . "(300) NOT NULL",
			'celeb_address_2' => Schema::TYPE_STRING . "(300) NOT NULL",
			'celeb_city' => Schema::TYPE_STRING . "(100) NOT NULL",
			'celeb_state' => Schema::TYPE_STRING . "(100) NOT NULL",
			'celeb_zip' => Schema::TYPE_STRING . "(50) NOT NULL",
			'willing_to_host' => Schema::TYPE_INTEGER . "(11) NOT NULL",
			'comments' => Schema::TYPE_TEXT . " NOT NULL",
		], $this->tableOptions);

		// users_id
		$this->createTable('{{%users_id}}', [
			'id' => Schema::TYPE_PK,
			'user_id' => Schema::TYPE_INTEGER . "(11) NOT NULL",
			'season_id' => Schema::TYPE_INTEGER . "(11) NOT NULL",
			'dynamic_id' => Schema::TYPE_INTEGER . "(11) NOT NULL",
		], $this->tableOptions);

		// widgets
		$this->createTable('{{%widgets}}', [
			'id' => Schema::TYPE_PK,
			'title' => Schema::TYPE_STRING . "(100) NOT NULL",
			'slug' => Schema::TYPE_STRING . "(100) NOT NULL",
			'description' => Schema::TYPE_TEXT . " NOT NULL",
		], $this->tableOptions);

		// widgets_areas
		$this->createTable('{{%widgets_areas}}', [
			'id' => Schema::TYPE_PK,
			'title' => Schema::TYPE_STRING . "(100) NOT NULL",
			'slug' => Schema::TYPE_STRING . "(100) NOT NULL",
		], $this->tableOptions);

		// widgets_in_areas
		$this->createTable('{{%widgets_in_areas}}', [
			'id' => Schema::TYPE_PK,
			'widget_id' => Schema::TYPE_INTEGER . "(11) NOT NULL",
			'area_id' => Schema::TYPE_INTEGER . "(11) NOT NULL",
			'params' => Schema::TYPE_TEXT . " NOT NULL",
			'order' => Schema::TYPE_INTEGER . "(11) NOT NULL",
		], $this->tableOptions);

		// fk: layouts_settings
		$this->addForeignKey('fk_layouts_settings_layout_id', '{{%layouts_settings}}', 'layout_id', '{{%layouts}}', 'id', 'CASCADE', 'CASCADE');

		// fk: layouts_widgets_areas
		$this->addForeignKey('fk_layouts_widgets_areas_layout_id', '{{%layouts_widgets_areas}}', 'layout_id', '{{%layouts}}', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('fk_layouts_widgets_areas_widget_area_id', '{{%layouts_widgets_areas}}', 'widget_area_id', '{{%widgets_areas}}', 'id', 'CASCADE', 'CASCADE');

		// fk: menu_items
		$this->addForeignKey('fk_menu_items_menu_id', '{{%menu_items}}', 'menu_id', '{{%menu}}', 'id', 'CASCADE', 'CASCADE');

		// fk: pages
		$this->addForeignKey('fk_pages_html_page_id', '{{%pages}}', 'html_page_id', '{{%html_pages}}', 'id', 'CASCADE', 'CASCADE');

		// fk: pages_revisions
		$this->addForeignKey('fk_pages_revisions_page_id', '{{%pages_revisions}}', 'page_id', '{{%pages}}', 'id', 'CASCADE', 'CASCADE');
		
		$this->createIndex('ind_dynamic_id', '{{users_id}}', 'dynamic_id');

		// fk: user_check
		$this->addForeignKey('fk_user_check_user_id', '{{%user_check}}', 'user_id', '{{%users_id}}', 'dynamic_id', 'CASCADE', 'CASCADE');

		// fk: user_info
		$this->addForeignKey('fk_user_info_user_id', '{{%user_info}}', 'user_id', '{{%users}}', 'id', 'CASCADE', 'CASCADE');

		// fk: user_profile_history
		$this->addForeignKey('fk_user_profile_history_user_id', '{{%user_profile_history}}', 'user_id', '{{%users}}', 'id', 'CASCADE', 'CASCADE');

		// fk: users_hosts
		$this->addForeignKey('fk_users_hosts_user_id', '{{%users_hosts}}', 'user_id', '{{%users_id}}', 'dynamic_id', 'CASCADE', 'CASCADE');

		// fk: users_id
		$this->addForeignKey('fk_users_id_user_id', '{{%users_id}}', 'user_id', '{{%users}}', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('fk_users_id_season_id', '{{%users_id}}', 'season_id', '{{%seasons}}', 'id', 'CASCADE', 'CASCADE');

		// fk: widgets_in_areas
		$this->addForeignKey('fk_widgets_in_areas_widget_id', '{{%widgets_in_areas}}', 'widget_id', '{{%widgets}}', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('fk_widgets_in_areas_area_id', '{{%widgets_in_areas}}', 'area_id', '{{%widgets_areas}}', 'id', 'CASCADE', 'CASCADE');
		
		$this->insert('{{%layouts}}', [
            "id" => "1",
            "url" => '',
            "parent_id" => '0',
        ]);

		$this->insert('{{%user}}', [
			"id" => "1",
			"username" => 'admin',
			"auth_key" => 's6rUpV91mW8WLRdMJVprl3_PMcGzBgqZ',
			"password_hash" => '$2y$13$WYyyPUYSuotBJReo9FBovuLyOTAA860JMzjb22nG4df0lTBNgqW9m',
			"password_reset_token" => '',
			"email" => 'admin@admin.com',
			"status" => '10',
			"created_at" => '1450275212',
			"updated_at" => '1450275212',
		]);

		$this->insert('{{%seasons}}', [
			"id" => "1",
			"title" => 'Main',
			"active" => '1',
		]);
    }

    public function safeDown()
    {
		
		$this->dropTable('{{%seasons}}');
		$this->dropTable('{{%users_hosts}}');
		$this->dropTable('{{%user_check}}');
		$this->dropTable('{{%user_info}}');
		$this->dropTable('{{%user_profile_history}}');
		$this->dropTable('{{%users_id}}');
		$this->dropTable('{{%users}}');
		$this->dropTable('{{%layouts_settings}}');
		$this->dropTable('{{%layouts_widgets_areas}}');
		$this->dropTable('{{%menu_items}}');
		$this->dropTable('{{%pages_revisions}}');
		$this->dropTable('{{%pages}}');
		$this->dropTable('{{%widgets_in_areas}}');
		$this->dropTable('{{%faq}}');
		$this->dropTable('{{%favorite_urls}}');
		$this->dropTable('{{%glossary}}');
		$this->dropTable('{{%html_pages}}');
		$this->dropTable('{{%layouts}}');
		$this->dropTable('{{%menu}}');
		$this->dropTable('{{%recent_urls}}');
		$this->dropTable('{{%seo_parameters}}');
		$this->dropTable('{{%seo_settings}}');
		$this->dropTable('{{%widgets}}');
		$this->dropTable('{{%widgets_areas}}');
		
    }
}
