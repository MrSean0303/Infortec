<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%venda}}`.
 */
class m191113_235431_create_venda_table extends Migration
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

        $this->createTable('{{%venda}}', [
            'idVenda' => $this->primaryKey(),
            'totalVenda' => $this->money(.2)->notNull(),
            'data' => $this->dateTime()->notNull(),
            'utilizador_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            'fk-venda_utilizador',
            'venda',
            'utilizador_id',
            'utilizador',
            'idUtilizador',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%venda}}');
    }
}
