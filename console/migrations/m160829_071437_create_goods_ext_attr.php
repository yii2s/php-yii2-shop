<?php

use yii\db\Migration;

class m160829_071437_create_goods_ext_attr extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%goods_ext_attr}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull()->comment('属性名称'),
            'value' => $this->string(200)->notNull()->comment('属性值'),
            'uid' => $this->integer()->notNull(),
            'gid' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'status' => $this->smallInteger(1)->defaultValue(0)->comment('0正常,1已删除')
        ], $tableOptions);
    }

    public function down()
    {
        echo "m160829_071437_create_goods_ext_attr cannot be reverted.\n";

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
