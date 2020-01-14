<?php namespace common\tests\unit\models;

use common\fixtures\UserFixture;
use common\models\Produto;
use common\models\User;

class ProdutoTest extends \Codeception\Test\Unit
{
    /**
     * @var \common\tests\UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    public function _fixtures()
    {
    }

    // tests
    public function testNewProduto()
    {
        $produto = new Produto();
        $produto->nome = 'abc';
        $produto->fotoProduto = 'sdaads';
        $produto->descricao = 'asdasd';
        $produto->descricaoGeral = 'saddas';
        $produto->preco = 20.15;
        $produto->valorDesconto = 0;
        $produto->pontos = 0;
        $produto->subCategoria_id = 1;
        $produto->iva_id = 1;
        $produto->quantStock = 2030;

        $produto->save();
        $this->tester->seeInDatabase('produto', ['nome' => 'abc']);

        //Update Test
        $prod = Produto::find()->where(['nome' => 'abc'])->one();
        $prod->nome = 'nome Mudado';
        $prod->preco = 150.10;
        $prod->quantStock = 100;
        $prod->save();

        $this->tester->seeInDatabase('produto', ['nome' => 'nome Mudado', 'preco' => 150.10, 'quantStock' => 100]);

        //Delete Test
        $prod->delete();
        $this->tester->cantseeInDatabase('produto', ['nome' => 'nome Mudado', 'preco' => 150.10, 'quantStock' => 100]);
    }

    public function testProdutoErrors()
    {
        $produto = new Produto();
        $produto->nome = "dsaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa";
        $this->assertFalse($produto->validate(['nome']), "Produto: Sem erro nome");

        $produto->fotoProduto = 'zrxdtcfyvguhbdddddddddddddddddddddddddddddddddddddddddddddddddddddddinjomkjnbvfcdfvgbhnmnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnn';
        $this->assertFalse($produto->validate(['fotoProduto']), "Produto: Sem erro foto");

        $produto->subCategoria_id = 1111;
        $this->assertFalse($produto->validate(['subCategoria_id']), "Produto: Sem erro subCategoria_id");

        $produto->iva_id = 1111;
        $this->assertFalse($produto->validate(['iva_id']), "Produto: Sem erro iva_id");

        $produto->preco = "11,12";
        $this->assertFalse($produto->validate(['preco']), "Produto: Sem erro preco");
    }

}