<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%contacto}}`.
 */
class m191114_001416_create_contacto_table extends Migration
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

        $this->createTable('{{%contacto}}', [
            'idContacto' => $this->primaryKey(),
            'numero' => $this->integer()->notNull(),
            'utilizador_id' => $this->integer()->notNull(),
            'indicativo_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            'fk-contacto_utilizador',
            'contacto',
            'utilizador_id',
            'utilizador',
            'idUtilizador',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-contacto_indicativo',
            'contacto',
            'indicativo_id',
            'indicativo',
            'idIndicativo',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%contacto}}');
    }
}
