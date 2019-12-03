<?php

/* @var $this yii\web\View */
/* @var $infositecontroller SiteController*/
/* @var $prod SiteController*/


use common\models\Produto;
use frontend\controllers\SiteController;
use phpDocumentor\Reflection\Types\Null_;
use yii\helpers\Html;
use yii\helpers\url;

$this->title = 'Produtos Infortec';
?>
<div class="site-index">
<h1><?= $infositecontroller; ?></h1>
    <div class="allCards">
        <?php
        foreach ($prod as $produtos) {
            $preco = number_format($produtos->preco, 2, ',', ' ');
            ?>
            <div class="product-show card" style="width:24%;">
                <?= Html::a('
                     <img class="card-img-top" src="' .Url::to('@web/Imagens/').$produtos->fotoProduto. '" alt="Card image cap">
                    <div class="product-card card-body">
                        <h4 class="product-title card-title">'. $produtos->nome . '</h4>
                        <h4 class="card-subtitle mb-2 text-muted" style="text-align: center !important;">'. $preco .' €</h4>
                        <p class="product-specs card-text">'. $produtos->descricaoGeral .'</p>
                    </div>
                ', [ 'produto/view', 'id' => $produtos->idProduto]);
                ?>

            </div>
            <?php } ?>
    </div>

</div>
