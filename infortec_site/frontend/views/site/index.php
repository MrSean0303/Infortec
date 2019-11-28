<?php

/* @var $this yii\web\View */
/* @var $prod SiteController*/


use common\models\Produto;
use frontend\controllers\SiteController;
use phpDocumentor\Reflection\Types\Null_;
use yii\helpers\Html;


$prs = $prod;

$this->title = 'My Yii Application';
?>
<div class="site-index">


        <div class="allCards">
        <?php
        foreach ($products as $produtos) {
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
            <div class="card" style="width:24%;">
            <?= Html::a('
                     <img class="card-img-top" src="data:image/jpg;base64,' .  base64_encode($data). '" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title">'. $produtos->nome . '</h4>
                        <h4 class="card-subtitle mb-2 text-muted">'. $preco .' €</h4>
                        <p class="card-text">'. $produtos->descricaoGeral .'</p>
                    </div>
                ', [ 'produto/view', 'id' => $produtos->idProduto])
                ?>

            </div>

            <?php
        } ?>
        </div>

</div>
