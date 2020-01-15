<?php
namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use common\fixtures\UserFixture;

class ProdutoCest
{
    public function _fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'login_data.php'
            ]
        ];
    }

    public function _before(FunctionalTester $I)
    {
        $I->amOnPage('/site/login');
        $I->submitForm('#login-form',['LoginForm[username]' => 'erau', 'LoginForm[password]' => 'password_0']);
    }

    protected function formParams($nome, $fotoProduto, $descricao, $descricaoGeral, $preco, $quantStock, $valorDesconto, $pontos, $subCategoria_id, $iva_id)
    {
        return [
            'ProdutoForm[nome]' => $nome,
            'ProdutoForm[fotoProduto]' => $fotoProduto,
            'ProdutoForm[descricao]' => $descricao,
            'ProdutoForm[descricaoGeral]' => $descricaoGeral,
            'ProdutoForm[preco]' => $preco,
            'ProdutoForm[quantStock]' => $quantStock,
            'ProdutoForm[valorDesconto]' => $valorDesconto,
            'ProdutoForm[pontos]' => $pontos,
            'ProdutoForm[subCategoria_id]' => $subCategoria_id,
            'ProdutoForm[iva_id]' => $iva_id,
        ];
    }

    // tests
    public function tryToTest(FunctionalTester $I)
    {
        $I->amOnPage('/produto/create');
        $I->see('Create Produto');
        $I->submitForm('#product-form', $this->formParams('Abc','abc.png','sdasdsadas','sdasdasd','10.5','1','1','1','1','1'));

        $I->amOnPage('/produto/index');
        $I->see('Produtos');
        $I->see('Abc');
    }
}
