<?php namespace common\tests\unit\models;

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
    public function testCategoria()
    {
        $categoria = new Categoria();
        $categoria->nome = 'test';

        $categoria->save();
        $this->tester->seeInDatabase('categoria', ['nome' => 'test']);

        //Update Test
        $categ = Categoria::find()->where(['nome' => 'test'])->one();
        $categ->nome = 'nome Mudado';
        $categ->save();

        $this->tester->seeInDatabase('categoria', ['nome' => 'nome Mudado']);

        //Delete Test
        $categ->delete();
        $this->tester->cantSeeInDatabase('categoria', ['nome' => 'nome Mudado']);
    }

    public function testCategoriaErrors()
    {
        $categoria = new Categoria();
        $categoria->nome = "dsaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa";
        $this->assertFalse($categoria->validate(['nome']), "Categoria: Sem erro nome");
    }
}