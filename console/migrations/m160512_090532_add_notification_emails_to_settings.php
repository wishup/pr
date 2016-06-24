<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160512_090532_add_notification_emails_to_settings extends Migration
{
    public function up()
    {
		$this->addColumn('{{%settings}}', 'notification_email', "varchar(100) NULL");
		$this->addColumn('{{%settings}}', 'notification_email_bcc', "varchar(300) NULL");
    }

    public function down()
    {
		$this->dropColumn('{{%settings}}', 'notification_email' );
		$this->dropColumn('{{%settings}}', 'notification_email_bcc' );
    }
}
