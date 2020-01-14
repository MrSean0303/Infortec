<?php namespace common\tests;

use common\models\Categoria;

class CategoriaTest extends \Codeception\Test\Unit
{
    /**
     * @var \common\tests\UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testSomeFeature()
    {
        $categoria = new Categoria();
        $categoria->nome = 'test';

        $categoria->save();
        $this->tester->seeInDatabase('categoria', ['nome' => 'test']);
    }
}