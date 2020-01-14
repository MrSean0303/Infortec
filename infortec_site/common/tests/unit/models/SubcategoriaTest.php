<?php namespace common\tests;

use common\models\Subcategoria;

class SubcategoriaTest extends \Codeception\Test\Unit
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
    public function testSubcategoria()
    {
        $subcategoria = new Subcategoria();
        $subcategoria->nome = "Teste";
        $subcategoria->categoria_id = 1;

        $subcategoria->save();
        $this->tester->seeInDatabase('subcategoria', ['nome' => 'Teste']);

        //Update Test
        $sub = Subcategoria::find()->where(['nome' => 'Teste'])->one();
        $sub->nome = "Nome mudado";
        $sub->save();

        $this->tester->seeInDatabase('subcategoria', ['nome' => 'Nome mudado']);

        //Delete Test
        $sub->delete();
        $this->tester->cantSeeInDatabase('subcategoria', ['nome' => 'Nome mudado']);
    }

    public function testSubcategoriaErrors()
    {
        $subcategoria = new Subcategoria();
        $subcategoria->nome = "sadsadasdassdassdasdsajdsajdsadhasdhwqhdlidhwgdfhevfhjkhwfjwnerhfgewhjfgehfewjfejwrjiejrjehewjklfweipifuehjqknflndofnsdjfçkdskfkldjfkdfjwhfjeqçfklçeqjfklewfjkhesdjfkdsfiebifbjefhkjewbfejbfjehfjejefewfjkewhjfewjfewjfewjlfnwnefjdekfekwfkewljfeklwekkfnenfjehioweddddddddddddddddddddddddddddddddd";
        $this->assertFalse($subcategoria->validate(['nome']), "Subcategoria: Sem erro nome");

        $subcategoria->categoria_id = 47.123;
        $this->assertFalse($subcategoria->validate(['categoria_id']), "Subcategoria: Sem erro categoria_id");

        $subcategoria->categoria_id = 412321312312321312312321123;
        $this->assertFalse($subcategoria->validate(['categoria_id']), "Subcategoria: Sem erro categoria_id");
    }
}