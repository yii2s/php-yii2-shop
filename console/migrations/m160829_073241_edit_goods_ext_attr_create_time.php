<?php

use yii\db\Migration;

class m160829_073241_edit_goods_ext_attr_create_time extends Migration
{
    public function up()
    {
        $this->alterColumn('{{%goods_ext_attr}}', 'create_time', 'datetime');
    }

    public function down()
    {
        echo "m160829_073241_edit_goods_ext_attr_create_time cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
