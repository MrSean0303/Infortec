<?php

namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use common\fixtures\UserFixture;
use yii;

/**
 * Class LoginCest
 */
class LoginCest
{
    /**
     * Load fixtures before db transaction begin
     * Called in _before()
     * @see \Codeception\Module\Yii2::_before()
     * @see \Codeception\Module\Yii2::loadFixtures()
     * @return array
     */
    public function _fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'login_data.php'
            ]
        ];
    }

    protected function formParams($login, $password)
    {
        return [
            'LoginForm[username]' => $login,
            'LoginForm[password]' => $password,
        ];
    }

    /**
     * @param FunctionalTester $I
     */
    public function loginUser(FunctionalTester $I)
    {
        $I->amOnPage('/site/login');
        $I->submitForm('#login-form', $this->formParams('erau', 'password_0'));
        $I->see('Logout (erau)', 'form button[type=submit]');

        //$I->see('Please fill out the following fields to login:');

        //$I->click('login-button', 'form button[type=submit]');


        /*$controllerl = Yii::$app->controller;
        $homecheker = $controllerl->id.'/'.$controllerl->action->id;
        var_dump($homecheker);
        die();*/

        //$I->see('Logout (erau)', 'form button[type=submit]');
        //$I->dontSeeLink('Login');
        //$I->dontSeeLink('Signup');
    }
}
