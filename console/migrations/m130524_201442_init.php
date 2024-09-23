<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->insert('{{%user}}', [
            'id' => 1,
            'username' => 'admin',
            'auth_key' => 'k-bOkhiG1QIVjZUBX1opkbSbCqvaOuB6',
            'password_hash' => '$2y$13$4m7oCd.btm2Mvn/iP5x.ju69AXokBI8nW3himMVp0VzvIpve7N5nW',
            'password_reset_token' => null,
            'email' => 'admin@admin.ru',
            'status' => 10,
            'created_at' => 1727070776,
            'updated_at' => 1727070776,
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
