<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%favorito}}`.
 */
class m191113_235005_create_favorito_table extends Migration
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

        $this->createTable('{{%favorito}}', [
            'idFavorito' => $this->primaryKey(),
            'produto_id' => $this->integer(),
            'utilizador_id' => $this->integer(),
        ],$tableOptions);

        $this->addForeignKey(
            'fk-favorito_produto',
            'favorito',
            'produto_id',
            'produto',
            'idProduto',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-favorito_utilizador',
            'favorito',
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
        $this->dropTable('{{%favorito}}');
    }
}
