<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%indicativo}}`.
 */
class m191114_001109_create_indicativo_table extends Migration
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

        $this->createTable('{{%indicativo}}', [
            'idIndicativo' => $this->primaryKey(),
            'icon' => 'LONGBLOB',
            'pais' => $this->string()->notNull()->unique(),
            'indicativo' => $this->string()->notNull()->unique(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%indicativo}}');
    }
}
