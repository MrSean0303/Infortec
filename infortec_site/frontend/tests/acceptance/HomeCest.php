<?php
namespace frontend\tests\acceptance;

use frontend\tests\AcceptanceTester;
use yii\helpers\Url;

class HomeCest
{
    public function checkHome(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/site/index'));
        $I->see('Infortec');

        $I->seeLink('Sobre Nós');
        $I->click('Sobre Nós');

        $I->seeLink('About');
        $I->click('About');
        $I->wait(2); // wait for page to be opened

        $I->see('Infortec é uma empresa de venda de produtos informáticos principalmente de forma Online, através de encomendas.');
    }
}
