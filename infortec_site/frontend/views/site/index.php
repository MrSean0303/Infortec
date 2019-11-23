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

    <?php
    if($prs != null) {
        ?>

        <div class="row">

            <?php
            for ($i = 1; $i <= count($prs); $i++) {

                ?>
                <div class="col-md-4">
                    <?php
                    $image = imagecreatefromstring($prs[$i]->fotoProduto);
                    ob_start(); //You could also just output the $image via header() and bypass this buffer capture.
                    imagejpeg($image, null, 80);
                    $data = ob_get_contents();
                    ob_end_clean();
                    echo '<img src="data:image/jpg;base64,' . base64_encode($data) . '" height="150" width="150" />';
                    echo '<br>';
                    echo $prs[$i]->nome;
                    echo '<br>';
                    echo $prs[$i]->preco, '€';

                    ?>

                </div>
                <?php
            }

            ?>
        </div>
        <?php
    }
    ?>
        <div class="allCards">
        <?php
        $num = 30;
        for($i = 0; $i<$num; $i++)
        {?>
            <div class="card" style="width:24%;">
                <img class="card-img-top" src="..." alt="Card image cap">
                <div class="card-body">
                    <h4 class="card-title">Card title</h4>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
        <?php } ?>
        </div>
</div>
