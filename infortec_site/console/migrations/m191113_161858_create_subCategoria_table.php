<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%subCategoria}}`.
 */
class m191113_161858_create_subCategoria_table extends Migration
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

        $this->createTable('{{%subCategoria}}', [
            'idsubCategoria' => $this->primaryKey(),
            'nome' => $this->string()->notNull()->unique(),
            'categoria_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
        'fk-Categoria_SubCategoria',
        'subCategoria',
        'categoria_id',
        'categoria',
        'idCategoria',
        'CASCADE'
        );

        //Inserir na base de dados
        $this->insert('subCategoria', [
            'idsubCategoria' => 1,
            'nome' => 'Desktops',
            'categoria_id' => 1
        ]);

        $this->insert('subCategoria', [
            'idsubCategoria' => 2,
            'nome' => 'NoteBooks',
            'categoria_id' => 1
        ]);

        $this->insert('subCategoria', [
            'idsubCategoria' => 3,
            'nome' => 'Placas Gráficas',
            'categoria_id' => 2
        ]);

        $this->insert('subCategoria', [
            'idsubCategoria' => 4,
            'nome' => 'Memórias RAM',
            'categoria_id' => 2
        ]);

        $this->insert('subCategoria', [
            'idsubCategoria' => 5,
            'nome' => 'Ventoinhas',
            'categoria_id' => 2
        ]);

        $this->insert('subCategoria', [
            'idsubCategoria' => 6,
            'nome' => 'Motherboard',
            'categoria_id' => 2
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%subCategoria}}');
    }
}
