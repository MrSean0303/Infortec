<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%produto}}`.
 */
class m191113_164827_create_produto_table extends Migration
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

        //,
        $this->createTable('{{%produto}}', [
            'idProduto' => $this->primaryKey(),
            'nome' =>$this->string()->notNull(),
            'fotoProduto' => $this->binary(),
            'descricao' => $this->text()->notNull(),
            'preco' => $this->money(2)->notNull(),
            'quantStock' => $this->integer()->notNull(),
            'valorDesconto' => $this->money(2),
            'pontos' => $this->integer(),
            'subCategoria_id' => $this->integer()->notNull(),
            'iva_id' => $this->integer(),
        ],$tableOptions);

        $this->addForeignKey(
            'fk-Produto_Categoria',
            'produto',
            'subCategoria_id',
            'categoria',
            'idCategoria',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-Produto_iva',
            'produto',
            'iva_id',
            'iva',
            'idIva',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%produto}}');
    }
}
