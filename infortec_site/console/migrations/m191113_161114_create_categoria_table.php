<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%categorias}}`.
 */
class m191113_161114_create_categoria_table extends Migration
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

        $this->createTable('{{%categoria}}', [
            'idCategoria' => $this->primaryKey(),
            'nome' => $this->string()->notNull()->unique(),
        ], $tableOptions);


        //Inserir na base de dados
        $this->insert( 'categoria', [
            'idCategoria' => 1,
            'nome' => 'Computadores'
        ]);
        $this->insert( 'categoria', [
            'idCategoria' => 2,
            'nome' => 'Componentes'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%categoria}}');
    }
}
