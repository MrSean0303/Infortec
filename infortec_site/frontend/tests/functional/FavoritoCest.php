<?php namespace frontend\tests\functional;
use frontend\tests\FunctionalTester;

class FavoritoCest
{
    public function _before(FunctionalTester $I)
    {
    }

    // tests
    public function tryToTest(FunctionalTester $I)
    {
        $I->amOnRoute('site/login');
        $I->submitForm('#login-form', [
            'Username' => 'admin',
            'Password' => 'admin123'
        ], 'login-button');

        //adicionar
        $I->see('Logout (admin)');
        $I->click('Computador Desktop Gaming GML-DR32DC9');
        $I->see('Computador Desktop Gaming GML-DR32DC9');
        $I->click(' Adicionar aos Favoritos');

        //verificar se adicionou
        $I->amOnRoute('favorito/index');
        $I->see('Computador Desktop Gaming GML-DR32DC9');
        $I->see('Logout (admin)');

        /*//apagar
        $I->amOnRoute('site/index');
        $I->click('Computador Desktop Gaming GML-DR32DC9');
        $I->see('Computador Desktop Gaming GML-DR32DC9');
        $I->click('.product_favoritos_text');

        //verificar se apagou
        $I->amOnRoute('favorito/index');
        $I->dontSee('Computador Desktop Gaming GML-DR32DC9');*/


    }
}
