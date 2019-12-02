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
            'icon' => $this->string()->notNull()->unique(),
            'pais' => $this->string()->notNull()->unique(),
            'indicativo' => $this->string()->notNull()->unique(),
        ], $tableOptions);

        $this->insert('indicativo',[
            'idIndicativo' => 1,
            'icon' => 'icon_Alemanha',
            'pais' => 'Deutschland',
            'indicativo' => '+49',
        ]);

        $this->insert('indicativo',[
            'idIndicativo' => 2,
            'icon' => 'icon_França',
            'pais' => 'France',
            'indicativo' => '+33',
        ]);

        $this->insert('indicativo',[
            'idIndicativo' => 3,
            'icon' => 'icon_EUA',
            'pais' => 'United States',
            'indicativo' => '+1',
        ]);

        $this->insert('indicativo',[
            'idIndicativo' => 4,
            'icon' => 'icon_Bangladesh',
            'pais' => 'গণপ্রজাতন্ত্রী বাংলাদেশ',
            'indicativo' => '+880',
        ]);

        $this->insert('indicativo',[
            'idIndicativo' => 5,
            'icon' => 'icon_Andorra',
            'pais' => 'Andorra',
            'indicativo' => '+34738',
        ]);

        $this->insert('indicativo',[
            'idIndicativo' => 6,
            'icon' => 'icon_Japao',
            'pais' => '日本国',
            'indicativo' => '+81',
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%indicativo}}');
    }
}
