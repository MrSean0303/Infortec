<?php

/* @var $this yii\web\View */

use common\models\Produto;
use phpDocumentor\Reflection\Types\Null_;
use yii\bootstrap\ActiveForm;

$prs = Produto::find()->indexBy('idProduto')->all();

/*
$image = imagecreatefromstring($prs[1]->fotoProduto);
ob_start(); //You could also just output the $image via header() and bypass this buffer capture.
imagejpeg($image, null, 80);
$data = ob_get_contents();
ob_end_clean();
echo '<img src="data:image/jpg;base64,' .  base64_encode($data)  . '" />';*/


$this->title = 'My Yii Application';
?>
<div class="site-index">

        <div class="allCards">
        <?php
        for($i = 1; $i<= count($prs); $i++) {
            if ($prs[$i]->fotoProduto != null){
                $image = imagecreatefromstring($prs[$i]->fotoProduto);
                ob_start(); //You could also just output the $image via header() and bypass this buffer capture.
                imagejpeg($image, null, 80);
                $data = ob_get_contents();
                ob_end_clean();
                }else{
                $data = 0;
            }
            ?>

            <div class="card" style="width:24%;">
                 <img class="card-img-top" <?= 'src="data:image/jpg;base64,' .  base64_encode($data). '"'?> alt="Card image cap">
                <div class="card-body">
                    <h4 class="card-title"><?= $prs[$i]->nome?></h4>
                    <h5 class="card-subtitle mb-2 text-muted"><?= $prs[$i]->preco .'€' ?></h5>
                    <p class="card-text"><?= $prs[$i]->descricao?></p>
                </div>
            </div>
        <?php } ?>
        </div>
</div>
