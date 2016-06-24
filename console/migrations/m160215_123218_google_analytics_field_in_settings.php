<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160215_123218_google_analytics_field_in_settings extends Migration
{
    public function safeUp()
    {
		$this->addColumn('{{%settings}}', 'google_analytics', $this->text());
    }

    public function safeDown()
    {
		$this->dropColumn('{{%settings}}', 'google_analytics');
    }
}
