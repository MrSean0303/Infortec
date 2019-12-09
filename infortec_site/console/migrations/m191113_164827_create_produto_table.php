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
            'fotoProduto' => $this->string()->notNull()->unique(),
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
            'fotoProduto' => 'prod_1',
            'descricao' => 'O seu computador desktop, com componentes selecionados e montagem Premium by PCDIGA: os maiores especialistas em informática e tecnologia em Portugal.',
            'descricaoGeral' => 'AMD Ryzen 3 2300X | Nox Infinity Atom RGB | Asus Prime A320M-K | Sapphire Radeon RX 470 4GB Bulk | 8GB RAM | SSD 240GB',
            'preco' => 1999.99,
            'quantStock' => 5454,
            'valorDesconto' => null,
            'pontos' => null,
            'subCategoria_id' => 1,
            'iva_id' => 1,
            ]);

        $this->insert('produto',[
            'idProduto' => 2,
            'nome' => 'Computador MSI Infinite 8RB-618XES Intel Core i5/GeForce GTX 1050 Ti',
            'fotoProduto' => 'prod_2',
            'descricao' => 'O seu computador desktop, com componentes selecionados e montagem Premium by PCDIGA: os maiores especialistas em informática e tecnologia em Portugal.',
            'descricaoGeral' => 'Intel Core i5-8400 | Free DOS | 8GB RAM | GeForce GTX 1050 Ti | SSD 256GB + HDD 1TB',
            'preco' => 699.00,
            'quantStock' => 54,
            'valorDesconto' => null,
            'pontos' => null,
            'subCategoria_id' => 1,
            'iva_id' => 1,
        ]);

        $this->insert('produto',[
            'idProduto' => 3,
            'nome' => 'Computador All-in-One HP PC 20-c404np',
            'fotoProduto' => 'prod_3',
            'descricao' => 'Quer a sua família pretenda navegar na Internet, desfrutar de conteúdos multimédia ou trabalhar no próximo grande projeto, este acessível PC All-in One foi redesenhado para oferecer a todos tudo aquilo de que necessitam. Uma explosão de cor e um desempenho fiável tornam-no perfeito para a sua sala de estar.',
            'descricaoGeral' => 'Intel Celeron J4005 | Windows 10 | 4GB RAM | Intel UHD Graphics 600 | HDD 1TB',
            'preco' => 429.00,
            'quantStock' => 54,
            'valorDesconto' => null,
            'pontos' => null,
            'subCategoria_id' => 1,
            'iva_id' => 1,
        ]);

        $this->insert('produto',[
            'idProduto' => 4,
            'nome' => 'Computador HP Pavilion Desktop TP01-0016np',
            'fotoProduto' => 'prod_4',
            'descricao' => 'O dia a dia exige desempenho excecional e durabilidade comprovada. O PC Desktop HP Pavilion oferece elevado desempenho e a fiabilidade de uma marca de confiança que protege o que é mais importante para si. O PC Desktop HP Pavilion oferece elevado desempenho e a fiabilidade de uma marca de confiança que protege o que é mais importante para si.',
            'descricaoGeral' => 'AMD Ryzen 3 2200G | Free DOS | 8GB RAM | Radeon Vega 8 | SSD 512GB',
            'preco' => 429.00,
            'quantStock' => 2030,
            'valorDesconto' => null,
            'pontos' => null,
            'subCategoria_id' => 1,
            'iva_id' => 1,
        ]);

        $this->insert('produto',[
            'idProduto' => 5,
            'nome' => 'Computador OMEN Desktop 880-093np - Recondicionado',
            'fotoProduto' => 'prod_5',
            'descricao' => 'O que distingue um jogador amador de um jogador lendário é a potência e o poder. O Desktop OMEN está equipado com um design inovador, o mais recente hardware do setor e a fácil capacidade de atualização para dominar os jogos AAA mais recentes e oferecer-lhe o melhor desempenho que a concorrência exige.',
            'descricaoGeral' => 'Intel Core i5-7400 | W10 Home | 8GB RAM | GeForce GTX 1050 | SSD 256GB',
            'preco' => 1299.00,
            'quantStock' => 5454,
            'valorDesconto' => null,
            'pontos' => 120,
            'subCategoria_id' => 1,
            'iva_id' => 1,
        ]);

        $this->insert('produto',[
            'idProduto' => 6,
            'nome' => 'Computador MSI Trident 3 8RB-293XES Intel Core i5/GeForce GTX 1050 Ti',
            'fotoProduto' => 'prod_6',
            'descricao' => 'A série Trident vem embalada com componentes de jogo de alto desempenho num formato compacto. Impulsionando incríveis níveis de potência e desempenho para todos os jogadores, a série MSI Trident redefinirá o tamanho dos PCs gaming.',
            'descricaoGeral' => 'Intel Core i5-8400 | Free DOS | 8GB RAM | GeForce GTX 1050 Ti | HDD 1TB',
            'preco' => 649.00,
            'quantStock' => 5454,
            'valorDesconto' => null,
            'pontos' => null,
            'subCategoria_id' => 1,
            'iva_id' => 1,
        ]);

        $this->insert('produto',[
            'idProduto' => 7,
            'nome' => 'Computador MSI Infinite 7RB-068XEU Intel Core i5/GeForce GTX 1050 Ti OC',
            'fotoProduto' => 'prod_7',
            'descricao' => 'O PC gaming MSI Infinite é construído para jogadores com um desejo sem fim em jogar. O melhor hardware de jogo do mundo com muitas ferramentas para realmente jogar da maneira que você quer. O PC Infinite está aqui para superar em inúmeras horas de jogos. Desafie os seus próprios limites!',
            'descricaoGeral' => 'Intel Core i5-7400 | Free DOS | 8GB RAM | GeForce GTX 1050 Ti | HDD 1TB',
            'preco' => 799.00,
            'quantStock' => 5454,
            'valorDesconto' => null,
            'pontos' => null,
            'subCategoria_id' => 1,
            'iva_id' => 1,
        ]);

        $this->insert('produto',[
            'idProduto' => 8,
            'nome' => 'Computador MSI Trident 3 8RB-019EU Intel Core i5/GeForce GTX 1050 Ti',
            'fotoProduto' => 'prod_8',
            'descricao' => 'A série Trident vem embalada com componentes de jogo de alto desempenho num formato compacto. Impulsionando incríveis níveis de potência e desempenho para todos os jogadores, a série MSI Trident redefinirá o tamanho dos PCs gaming.',
            'descricaoGeral' => 'Intel Core i5-8400 | W10 Home | 8GB RAM | GeForce GTX 1050 Ti | HDD 1TB',
            'preco' => 899.00,
            'quantStock' => 5454,
            'valorDesconto' => null,
            'pontos' => null,
            'subCategoria_id' => 1,
            'iva_id' => 1,
        ]);

        $this->insert('produto',[
            'idProduto' => 9,
            'nome' => 'Ventoinha 200mm Cooler Master 800RPM MasterFan MF200R RGB 3 Pinos',
            'fotoProduto' => 'comp_9',
            'descricao' => 'Apresentamos a MasterFan MF200R. A MF200R foi especialmente concebida para maximizar o fluxo de ar na sua caixa, combinando tanto o conceito High Air Flow quanto o tamanho de 200mm. A MF200R também é compatível com RGB, oferecendo-lhe a capacidade de personalizar completamente a cor para combinar com a sua caixa e componentes. Ela também fornece o equilíbrio perfeito entre desempenho e silêncio através da exclusiva tecnologia da Cooler Master de cancelamento de ruído. Esta ventoinha é a mistura perfeita entre desempenho, personalização de cores e silêncio.',
            'descricaoGeral' => 'Cooler Master',
            'preco' => 15.90,
            'quantStock' => 5454,
            'valorDesconto' => null,
            'pontos' => null,
            'subCategoria_id' => 5,
            'iva_id' => 1,
        ]);

        $this->insert('produto',[
            'idProduto' => 10,
            'nome' => 'Placa Gráfica Gigabyte GT 710 2GB LP',
            'fotoProduto' => 'comp_10',
            'descricao' => 'O dissipador da Gigabyte GeForce® GT 710 foi desenhado com uma grande área de superfície para que passivamente mantenha a placa gráfica nas temperaturas ideias - perfeito para a construção de computadores HTPC e centros multimédia.',
            'descricaoGeral' => 'Gigabyte',
            'preco' => 42.50,
            'quantStock' => 5454,
            'valorDesconto' => null,
            'pontos' => null,
            'subCategoria_id' => 3,
            'iva_id' => 1,
        ]);

        $this->insert('produto',[
            'idProduto' => 11,
            'nome' => 'Placa Longshine 1 Paralela PCI',
            'fotoProduto' => 'comp_11',
            'descricao' => 'A LCS-6019 é uma placa controladora MultiI/O para o slot PCI. Hoje, muitas motherboards vêm sem Portas Serial ou Paralelas, a LCS-6019 é a solução perfeita.. O Adaptador é útil para Impressoras e outros Dispositivos.',
            'descricaoGeral' => 'Longshine',
            'preco' => 14.90,
            'quantStock' => 5454,
            'valorDesconto' => null,
            'pontos' => null,
            'subCategoria_id' => 3,
            'iva_id' => 1,
        ]);

        $this->insert('produto',[
            'idProduto' => 12,
            'nome' => 'Memória RAM Kingston SO-DIMM 4GB (1x4GB) DDR3-1600MHz CL11',
            'fotoProduto' => 'comp_12',
            'descricao' => 'A Kingston Technology é o maior fabricante independente de memórias do mundo contando com uma excelente reputação pela qualidade dos seus produtos e pelos seus preços competitivos. A memória ValueRAM Desktop and Notebook Premier Memory da Kingston foi concebida para clientes que criam e/ou utilizam computadores de secretária ou portáteis de marca branca mas que pretendem uma lista de materiais concreta e controlada.',
            'descricaoGeral' => 'Kingston | DDR3-1600 MHz',
            'preco' => 20.20,
            'quantStock' => 5454,
            'valorDesconto' => null,
            'pontos' => null,
            'subCategoria_id' => 4,
            'iva_id' => 1,
        ]);

        $this->insert('produto',[
            'idProduto' => 13,
            'nome' => 'Motherboard Micro-ATX MSI A320M-A Pro Max',
            'fotoProduto' => 'comp_13',
            'descricao' => 'As motherboards MSI foram projetadas com vários recursos inteligentes para configuração e uso convenientes, como zona de exclusão pin-header, localização SATA e USB amigável e várias soluções de refrigeração, para que os utilizadores DIY possam escolher qualquer plataforma gaming que desejarem.',
            'descricaoGeral' => 'Motherboard AMD AM4 inspirada em projeto arquitetónico, com Core Boost, DDR4 Boost, Turbo M.2 e USB 3.2 Gen1.',
            'preco' => 47.90,
            'quantStock' => 5454,
            'valorDesconto' => null,
            'pontos' => null,
            'subCategoria_id' => 6,
            'iva_id' => 1,
        ]);

        $this->insert('produto',[
            'idProduto' => 14,
            'nome' => 'Portátil Acer Aspire 3 15.6" A315-54K-33ZJ',
            'fotoProduto' => 'prod_14',
            'descricao' => 'Assista a vídeos com facilidade e rapidez, navegue na Web ou faça algum trabalho com o processador Intel® Core™ da 7ª Geração. Os aplicativos são carregados mais rapidamente, os gráficos têm melhor desempenho e a multitarefa é mais eficiente com esta combinação poderosa.',
            'descricaoGeral' => 'Intel Core i3-7020U | Boot-up Linux | 8GB RAM | FHD 60Hz | UHD Graphics 620 | SSD 256GB',
            'preco' => 349.00,
            'quantStock' => 1235,
            'valorDesconto' => null,
            'pontos' => null,
            'subCategoria_id' => 2,
            'iva_id' => 1,
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
