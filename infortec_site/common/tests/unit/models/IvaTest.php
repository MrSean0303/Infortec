<?php namespace common\tests;

use common\models\Iva;

class IvaTest extends \Codeception\Test\Unit
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
    public function testIva()
    {
        $iva = new Iva();
        $iva->valorIva = 15;

        $iva->save();
        $this->tester->seeInDatabase('iva', ['valorIva' => 15]);

        //Update Test
        $ivaU = Iva::find()->where(['valorIva' => 15])->one();
        $ivaU->valorIva = 550;
        $ivaU->save();

        $this->tester->seeInDatabase('iva', ['valorIva' => 550]);

        //Delete Test
        $ivaU->delete();
        $this->tester->cantSeeInDatabase('iva', ['valorIva' => 550]);
    }

    public function testIvaErrors()
    {
        $iva = new Iva();
        $iva->valorIva = 4798786453178645316578743456486435567785546854534545454485453454545444;
        $this->assertFalse($iva->validate(['valorIva']), "Iva: Sem erro valorIva");

        $iva->valorIva = 47.123;
        $this->assertFalse($iva->validate(['valorIva']), "Iva: Sem erro valorIva");
    }
}