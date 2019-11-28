<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%iva}}`.
 */
class m191113_164611_create_iva_table extends Migration
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

        $this->createTable('{{%iva}}', [
            'idIva' => $this->primaryKey(),
            'valorIva' => $this->integer()->notNull()->unique(),
        ], $tableOptions);

        //Inserir na base de dados
        $this->insert('iva',[
            'idIva' => 1,
            'valorIva' => 23,
            ]);
        $this->insert('iva',[
            'idIva' => 2,
            'valorIva' => 22,
        ]);
        $this->insert('iva',[
            'idIva' => 3,
            'valorIva' => 18,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%iva}}');
    }
}
