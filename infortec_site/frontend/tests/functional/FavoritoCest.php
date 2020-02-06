<?php namespace frontend\tests\functional;
use common\fixtures\UserFixture;
use frontend\tests\FunctionalTester;
use yii;

class FavoritoCest
{
    public function _fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'login_data.php',
            ],
        ];
    }

    public function _before(FunctionalTester $I)
    {
    }

    // tests
    public function tryToTest(FunctionalTester $I)
    {
        //Verificar se não a produtos adcionados.
        $I->amOnRoute('favorito/index');
        $I->See('Não tem produtos nos favoritos');
        $I->dontSee('Computador Desktop Gaming GML-DR32DC9');


        //login para efetuar a adição/remoção
        $I->amOnPage('/site/login');
        $I->fillField('Username', 'erau');
        $I->fillField('Password', 'password_0');
        $I->click('login-button');
        $I->see('Logout (erau)', 'form button[type=submit]');

        //adicionar
        $I->click('Computador Desktop Gaming GML-DR32DC9');
        $I->see('Computador Desktop Gaming GML-DR32DC9');
        $I->click(' Adicionar aos Favoritos');
        $I->dontSee( ' Adicionar aos Favoritos');

        //verificar se adicionou
        $I->amOnRoute('favorito/index');
        $I->See('Computador Desktop Gaming GML-DR32DC9');
        $I->dontSee('Não tem produtos nos favoritos');

        //apagar
        $I->click('Computador Desktop Gaming GML-DR32DC9');
        $I->see('Computador Desktop Gaming GML-DR32DC9');
        $I->click(' Remover dos Favoritos');

        //verificar se apagou
        $I->amOnRoute('favorito/index');
        $I->See('Não tem produtos nos favoritos');
    }
}
