<?php
namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;

/* @var $scenario \Codeception\Scenario */

class FavoritosTest
{
    /*
    protected $tester;
    */
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function CheakAddFavorito(FunctionalTester $I)
    {
        $I->amOnRoute('site/login');

    }
}