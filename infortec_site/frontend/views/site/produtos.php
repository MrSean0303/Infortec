<?php

/* @var $this yii\web\View */
/* @var $prod SiteController*/

use common\models\Produto;
use frontend\controllers\SiteController;
use phpDocumentor\Reflection\Types\Null_;
use yii\helpers\Html;

$this->title = 'Produtos Infortec';
?>
<div class="site-index">

    <div class="allCards">
        <?php
        foreach ($prod as $produtos) {
            if ($produtos->fotoProduto != null){
                $image = imagecreatefromstring($produtos->fotoProduto);
                ob_start(); //You could also just output the $image via header() and bypass this buffer capture.
                imagejpeg($image, null, 80);
                $data = ob_get_contents();
                ob_end_clean();
            }else{
                $data = 0;
            }
            $preco = number_format($produtos->preco, 2, ',', ' ');
            ?>
            <div class="product-show card" style="width:24%;">
                <?= Html::a('
                     <img class="card-img-top" src="data:image/jpg;base64,' .  base64_encode($data). '" alt="Card image cap">
                    <div class="product-card card-body">
                        <h4 class="product-title card-title">'. $produtos->nome . '</h4>
                        <h4 class="card-subtitle mb-2 text-muted" style="text-align: center !important;">'. $preco .' €</h4>
                        <p class="product-specs card-text">'. $produtos->descricaoGeral .'</p>
                    </div>
                ', [ 'produto/view', 'id' => $produtos->idProduto])
                ?>

            </div>
            <?php
        }
        ?>
    </div>

</div>
