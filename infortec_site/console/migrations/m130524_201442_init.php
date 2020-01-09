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
            'role' => $this->integer()->notNull()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        //Pass = admin123
        $this->insert('user',[
            'id' => 1,
            'username' => 'admin',
            'auth_key' => 'EvmZ8MuvssUqsrzwn-W4KLP6UcJ8h0oI',
            'password_hash' => '$2y$13$2yQlB031hqOoqOmJ4s6Bfundxmmw0/DkkouhW3M8RtmUZyQQDZ556',
            'password_reset_token' => null,
            'email' => 'infortec.ipl@gmail.com',

            'status' => 10,
            'role' => 2,
            'created_at' => 1578569191,
            'updated_at' => 1578569191,
        ]);

    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }

}
