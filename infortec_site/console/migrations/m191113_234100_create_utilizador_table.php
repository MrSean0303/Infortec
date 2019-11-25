<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%utilizador}}`.
 */
class m191113_234100_create_utilizador_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%utilizador}}', [
            'idUtilizador' => $this->primaryKey(),
            'nome' => $this->string()->notNull(),
            'nif' => $this->integer()->unique(),
            'morada' => $this->string(),
            'cargo' => $this->integer()->notNull(),
            'numPontos' => $this->integer(),
            'user_id' => $this->integer(),
        ], $tableOptions);

        $this->addForeignKey(
            'fk-Utilizador_user',
            'utilizador',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%utilizador}}');
    }
}
