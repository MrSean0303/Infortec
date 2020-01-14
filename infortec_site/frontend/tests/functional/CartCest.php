<?php namespace frontend\tests\functional;
use frontend\tests\FunctionalTester;

class CartCest
{
    public function _before(FunctionalTester $I)
    {
    }

    // tests
    public function tryToTest(FunctionalTester $I)
    {
        $I->amOnRoute('site/index');
        $I->click('Computador Desktop Gaming GML-DR32DC9');
        $I->see('Computador Desktop Gaming GML-DR32DC9');
        $I->click(' Adicionar ao Carrinho');
        $I->see('Computador Desktop Gaming GML-DR32DC9');
        $I->click('Finalizar Compra');

        $I->amOnRoute('site/index');
    }
}
