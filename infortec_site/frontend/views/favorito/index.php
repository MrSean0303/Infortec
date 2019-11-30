<?php


/* @var $this yii\web\View */
/* @var $produtos FavoritoController */

use yii\helpers\Html;
use frontend\controllers\FavoritoController;
?>
<h1>Hello</h1>

<div class="site-index">
    <?php
    if ($produtos == null){
        echo "<h1>Não tem produtos nos favoritos</h1>";
    }else {
        foreach ($produtos as $produto) {
            if ($produto->fotoProduto != null) {
                $image = imagecreatefromstring($produto->fotoProduto);
                ob_start(); //You could also just output the $image via header() and bypass this buffer capture.
                imagejpeg($image, null, 80);
                $data = ob_get_contents();
                ob_end_clean();
            } else {
                $data = 0;
            }
            ?>
            <div class="allCards">
                <div class="card" style="width:24%;">
                    <?= Html::a('
            <img class="card-img-top" src="data:image/jpg;base64,' . base64_encode($data) . '" alt="Card image cap">
            <div class="card-body">
            <h4 class="card-title">' . $produto->nome . '</h4>
             </div>
             ', ['produto/view', 'id' => $produto->idProduto])
                    ?>
                </div>
            </div>

            <?php
        }
    }
    ?>
</div>
