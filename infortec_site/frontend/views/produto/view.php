<?php

use frontend\controllers\ProdutoController;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $prod ProdutoController*/

$this->title = $prod->nome;


    if ($prod->fotoProduto != null){
    $image = imagecreatefromstring($prod->fotoProduto);
    ob_start(); //You could also just output the $image via header() and bypass this buffer capture.
    imagejpeg($image, null, 80);
    $data = ob_get_contents();
    ob_end_clean();
    }else {
        $data = 0;
    }



?>

<div class="produto-view">


    <div style="width: 100%">

        <div>
            <img class="card-img-top" src=<?="data:image/jpg;base64,".  base64_encode($data)?> alt="No image">
            <div>
                <div>
                    <h1><?=$prod->nome?></h1>
                </div>
                <div style="text-align: right">
                    <h4><?=$prod->preco . "€"?></h4>
                </div>
                <div >
                    <p></p>
                </div>



            </div>
        </div>


    </div>




</div>
