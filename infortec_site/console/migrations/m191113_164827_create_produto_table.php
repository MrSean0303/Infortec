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
            'fotoProduto' => 'LONGBLOB',
            'descricao' => $this->text()->notNull(),
            'descricaoGeral' => $this->text()->notNull(),
            'preco' => $this->decimal(10,2)->notNull(),
            'quantStock' => $this->integer()->notNull(),
            'valorDesconto' => $this->decimal(10,2),
            'pontos' => $this->integer(),
            'subCategoria_id' => $this->integer()->notNull(),
            'iva_id' => $this->integer(),
        ],$tableOptions);

        $this->addForeignKey(
            'fk-Produto_subCategoria',
            'produto',
            'subCategoria_id',
            'subCategoria',
            'idsubCategoria',
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

        $this->insert('produto',[
            'idProduto' => 1,
            'nome' => 'Computador Desktop Gaming GML-DR32DC9',
            'fotoProduto' => null,
            'descricao' => 'O seu computador desktop, com componentes selecionados e montagem Premium by PCDIGA: os maiores especialistas em informática e tecnologia em Portugal.',
            'descricaoGeral' => 'AMD Ryzen 3 2300X | Nox Infinity Atom RGB | Asus Prime A320M-K | Sapphire Radeon RX 470 4GB Bulk | 8GB RAM | SSD 240GB',
            'preco' => 1999.99,
            'quantStock' => 5454,
            'valorDesconto' => null,
            'pontos' => null,
            'subCategoria_id' => 1,
            'iva_id' => 2,
            ]);

        $this->insert('produto',[
            'idProduto' => 2,
            'nome' => 'Computador MSI Infinite 8RB-618XES Intel Core i5/GeForce GTX 1050 Ti',
            'fotoProduto' => null,
            'descricao' => 'O seu computador desktop, com componentes selecionados e montagem Premium by PCDIGA: os maiores especialistas em informática e tecnologia em Portugal.',
            'descricaoGeral' => 'Intel Core i5-8400 | Free DOS | 8GB RAM | GeForce GTX 1050 Ti | SSD 256GB + HDD 1TB',
            'preco' => 699.00,
            'quantStock' => 54,
            'valorDesconto' => null,
            'pontos' => null,
            'subCategoria_id' => 1,
            'iva_id' => 2,
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%produto}}');
    }
}
