<?php

use frontend\controllers\ProdutoController;

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
        <div style="width: 90%">
            <div class="img-viewProduto" style="width: 40% float:left">
                <img class="card-img-top" src=<?="data:image/jpg;base64,".  base64_encode($data)?> alt="No image">
            </div>

            <div class="naosei">
                <div>
                    <h1><?=$prod->nome?></h1>
                </div>
                <div style="text-align: right">
                    <?php
                    if ($prod->valorDesconto != null){
                        $a = $prod->preco - $prod->valorDesconto;
                        $prod->preco = number_format($prod->preco, 2, ',', ' ');
                        $a = number_format($a, 2, ',', ' ');
                        echo '<h4><strike>'. $prod->preco.'</strike>'. ' ' .$a .' €'.'</h4>';
                    }else {
                        $prod->preco = number_format($prod->preco, 2, ',', ' ');
                        echo '<h4>'.$prod->preco.' €</h4>';
                    }
                    ?>
                </div>
                <div>
                    <p><?=$prod->descricao?></p>
                </div>
            </div>
        </div>
        <div style="">
            <h4>Informações Gerais do produto</h4>
            <ul>
                <?php
                    for ($i=0; $i < count($prod->descricaoGeral); $i++){
                        echo '<li>'.$prod->descricaoGeral[$i] . '</li>';
                    }
                ?>
            </ul>
        </div>

