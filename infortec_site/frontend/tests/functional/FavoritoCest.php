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
        //Verificar se não a produtos adcionados.
        $I->amOnRoute('favorito/index');
        $I->See('Não tem produtos nos favoritos');

        //login para efetuar a adição/remoção
        $I->amOnPage('/site/login');
        $I->fillField('Username', 'admin');
        $I->fillField('Password', 'admin123');
        $I->click('login-button');
        $I->see('Logout (admin)', 'form button[type=submit]');

        //adicionar
        $I->click('Computador Desktop Gaming GML-DR32DC9');
        $I->see('Computador Desktop Gaming GML-DR32DC9');
        $I->click(' Adicionar aos Favoritos');

        //verificar se adicionou
        $I->amOnRoute('favorito/index');
        $I->dontSee('Não tem produtos nos favoritos');
        $I->see('Computador Desktop Gaming GML-DR32DC9');


        //apagar
        $I->click('Computador Desktop Gaming GML-DR32DC9');
        $I->see('Computador Desktop Gaming GML-DR32DC9');
        $I->click(' Remover dos Favoritos');

        //verificar se apagou
        $I->amOnRoute('favorito/index');
        $I->See('Não tem produtos nos favoritos');
    }
}
