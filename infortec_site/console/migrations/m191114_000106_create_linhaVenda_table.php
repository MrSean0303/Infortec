<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%linhaVenda}}`.
 */
class m191114_000106_create_linhaVenda_table extends Migration
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

        $this->createTable('{{%linhaVenda}}', [
            'idlinhaVenda' => $this->primaryKey(),
            'quantidade' => $this->integer()->notNull()->defaultValue(0),
            'isPontos' => $this->boolean(),
            'preco' => $this->money(2)->notNull(),
            'venda_id' => $this->integer(),
            'produto_id' => $this->integer(),
        ], $tableOptions);

        $this->addForeignKey(
            'fk-linhaVenda_venda',
            'linhaVenda',
            'venda_id',
            'venda',
            'idVenda',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-linhaVenda_produto',
            'linhaVenda',
            'produto_id',
            'produto',
            'idProduto',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%linhaVenda}}');
    }
}
