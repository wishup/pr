<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m160120_140400_add_category_id_to_faq extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%faq}}', 'category_id', $this->integer(11));
        $this->addForeignKey('fk_faq_category_id', '{{%faq}}', 'category_id', '{{%faq_categories}}', 'id','CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropColumn('{{%faq}}', 'category_id');
    }
}
