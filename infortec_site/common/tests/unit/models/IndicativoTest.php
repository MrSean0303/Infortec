<?php namespace common\tests;

use common\models\Indicativo;

class IndicativoTest extends \Codeception\Test\Unit
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
    public function testIndicativo()
    {
        $indicativo = new Indicativo();
        $indicativo->icon = "icon de teste";
        $indicativo->pais = "Portugal-teste";
        $indicativo->indicativo = "+358";

        $indicativo->save();
        $this->tester->seeInDatabase('indicativo', ['indicativo' => '+358']);

        //Update Test
        $indica = Indicativo::find()->where(['indicativo' => '+358'])->one();
        $indica->icon = "abc";
        $indica->pais = "teste-troca";
        $indica->indicativo = "+351";
        $indica->save();

        $this->tester->seeInDatabase('indicativo', ['indicativo' => '+351']);

        //Delete Test
        $indica->delete();
        $this->tester->cantSeeInDatabase('indicativo', ['indicativo' => '+351']);

    }

    public function testIvaErrors()
    {
        $indicativo = new Indicativo();
        $indicativo->icon = "wqweqeqwddasdawwqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdad";
        $this->assertFalse($indicativo->validate(['icon']), "Indicativo: Sem erro icon");

        $indicativo->pais = "wqweqeqwddasdawwqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdad";
        $this->assertFalse($indicativo->validate(['pais']), "Indicativo: Sem erro país");

        $indicativo->indicativo = "wqweqeqwddasdawwqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdawqweqeqwddasdad";
        $this->assertFalse($indicativo->validate(['indicativo']), "Indicativo: Sem erro indicativo");
    }
}