<?php
namespace backend\tests\functional;
use backend\tests\FunctionalTester;
use common\fixtures\UserFixture;

class CategoriaCest
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

    // tests
    public function tryToTest(FunctionalTester $I)
    {
        $I->amOnPage('/categoria/create');
        $I->see('Create Categoria');

        $I->fillField('Nome', 'Test');
        $I->click('Save');

        $I->see('Test');


    }
}
