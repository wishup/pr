<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

/**
 * Handles adding slug to table `prod_attr`.
 */
class m160929_124011_add_slug_to_prod_attr extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('{{%shop_products_attributes}}', 'slug', 'varchar(200)');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('{{%shop_products_attributes}}', 'slug');
    }
}
