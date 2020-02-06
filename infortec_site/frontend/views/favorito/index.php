<?php


/* @var $this yii\web\View */
/* @var $produtos FavoritoController */

use yii\helpers\Html;
use frontend\controllers\FavoritoController;
use yii\helpers\Url;

?>
<h1 style="text-align: center">Lista de favoritos</h1>

<div class="site-index">
    <?php
    if ($produtos == null){
        echo "<h1 style='text-align: center'>Não tem produtos nos favoritos</h1>";
    }else {
        echo '<div class="allCards">';
        foreach ($produtos as $produto) {
    $precoAtual = null;
    if ($produto->valorDesconto > 0) {
        $precoAtual = $produto->preco - $produto->valorDesconto;
        $precoAtual = number_format($precoAtual, 2, ',', ' ');
    }

    $preco = number_format($produto->preco, 2, ',', ' ');
    ?>
    <div class="product-show card" style="width:24%;">
        <?php
        if ($precoAtual != null) {
            echo Html::a('
                     <img class="card-img-top" src="' . Url::to('@web/Imagens/') . $produto->fotoProduto . '" alt="Card image cap">
                    <div class="product-card card-body">
                        <h4 class="product-title card-title">' . $produto->nome . '</h4>
                        <h4 class="card-subtitle mb-2 text-muted" style="text-align: center !important;"><strike>' . $preco . '€</strike> ' . $precoAtual . ' €</h4>
                    </div>
                ', ['produto/view', 'id' => $produto->idProduto]);
            $precoAtual = null;
        } else {
            ?>
            <?= Html::a('
                     <img class="card-img-top" src="' . Url::to('@web/Imagens/') . $produto->fotoProduto . '" alt="Card image cap">
                    <div class="product-card card-body">
                        <h4 class="product-title card-title">' . $produto->nome . '</h4>
                        <h4 class="card-subtitle mb-2 text-muted" style="text-align: center !important;">' . $preco . ' €</h4>
                    </div>
                ', ['produto/view', 'id' => $produto->idProduto])
            ?>
            <?php
        }
        echo '</div>';
        }
        echo '</div>';
    }
    ?>
</div>
