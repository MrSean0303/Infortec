<?php

/* @var $this yii\web\View */
/* @var $prod SiteController*/
/* @var $subcate SiteController*/

use common\models\Produto;
use common\models\Subcategoria;
use frontend\controllers\SiteController;
use phpDocumentor\Reflection\Types\Null_;
use yii\helpers\Html;
use yii\helpers\url;
use common\models\Categoria;
use yii\bootstrap\ButtonDropdown;

$this->title = 'Infortec';
?>
<div class="site-index">
    <?php
    $nome = Yii::$app->getRequest()->getQueryParam('nome');

        $id = Categoria::find()->where(['nome' => $nome])->one()->idCategoria;
        $subcategorias = Categoria::findOne($id)->subcategorias;

        $items = [];
        foreach ($subcategorias as $subcat)     {
                $items[] = ['label' => $subcat->nome, 'url' => ['/site/categorias', 'nome' => $nome, 'subcate' => $subcat->nome], 'options'=> ['class'=>'buttonNoDec']];
            }
    ?>
            <h2  style="margin-bottom: 30px;"><?php
                if($subcate != 'null')
                    echo $nome . ": " . $subcate;
                else
                    echo $nome;
                ?></h2>
    <?php
    echo ButtonDropdown::widget([
        'label' => 'Sub-categorias',
        'dropdown' => [
            'items' => $items,
        ],
    ]); ?>

    <div class="allCards">

        <?php
        if($subcate != 'null')
        {
            $id = Subcategoria::find()->where(['nome' => $subcate])->one()->idsubCategoria;
            $prod = Subcategoria::findOne($id)->produtos;
        }
        foreach ($prod as $produtos) {
            $precoAtual = null;
            if ($produtos->valorDesconto > 0) {
                $precoAtual = $produtos->preco - $produtos->valorDesconto;
                $precoAtual = number_format($precoAtual, 2, ',', ' ');
            }

            $preco = number_format($produtos->preco, 2, ',', ' ');
            ?>
            <div class="product-show card" style="width:24%;">
                <?php
                if ($precoAtual != null) {
                    echo Html::a('
                     <img class="card-img-top" src="' . Url::to('@web/Imagens/') . $produtos->fotoProduto . '" alt="Card image cap">
                    <div class="product-card card-body">
                        <h4 class="product-title card-title">' . $produtos->nome . '</h4>
                        <h4 class="card-subtitle mb-2 text-muted" style="text-align: center !important;"><strike>' . $preco . '€</strike> ' . $precoAtual . ' €</h4>
                        <p class="product-specs card-text">' . $produtos->descricaoGeral . '</p>
                    </div>
                ', ['produto/view', 'id' => $produtos->idProduto]);
                    $precoAtual = null;
                } else {
                ?>
                <?= Html::a('
                     <img class="card-img-top" src="' . Url::to('@web/Imagens/') . $produtos->fotoProduto . '" alt="Card image cap">
                    <div class="product-card card-body">
                        <h4 class="product-title card-title">' . $produtos->nome . '</h4>
                        <h4 class="card-subtitle mb-2 text-muted" style="text-align: center !important;">' . $preco . ' €</h4>
                        <p class="product-specs card-text">' . $produtos->descricaoGeral . '</p>
                    </div>
                ', ['produto/view', 'id' => $produtos->idProduto])
                ?>
                <?php
            }?>

            </div>
            <?php
        }
        ?>
        </div>

</div>
