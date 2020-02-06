<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;

class HomeCest
{
    public function checkOpen(FunctionalTester $I)
    {
        $I->amOnPage(\Yii::$app->homeUrl);
        $I->see('Todos os Produtos');
        $I->seeLink('Sobre Nós');
        $I->click('Sobre Nós');

        $I->seeLink('About');
        $I->click('About');

        $I->see('Email da loja:');
    }
}