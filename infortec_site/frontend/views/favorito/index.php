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
            ?>
            <div class="product-show card" style="width:24%;">
                    <?= Html::a('<img class="card-img-top" src="'. Url::to('@web/Imagens/').$produto->fotoProduto .'" alt="Card image cap">
                        <div class="card-body">
                        <h4 class="card-title">' . $produto->nome . '</h4>
                        </div>',
                        ['produto/view', 'id' => $produto->idProduto])
                    ?>
            </div>

            <?php
        }
        echo '</div>';
    }
    ?>
</div>
