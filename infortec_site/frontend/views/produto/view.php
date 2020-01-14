<?php

use frontend\controllers\ProdutoController;
use yii\bootstrap\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $prod ProdutoController */
/* @var $isfavorito ProdutoController */

$this->title = $prod->nome;
?>
<div style="width: 90%;">
    <div class="product_informacaoLadoImagem">
        <div>
            <h1><?= $prod->nome ?></h1>
        </div>
        <div style="display: flex; width: 100%; margin-top: 3%">
            <div class="product_preco">
                <?php
                if ($prod->valorDesconto > 0) {
                    $a = $prod->preco - $prod->valorDesconto;
                    $prod->preco = number_format($prod->preco, 2, ',', ' ');
                    $a = number_format($a, 2, ',', ' ');
                    echo '<span style="color: black"><strike>' . $prod->preco . '€</strike></span>' . ' ' . $a . ' €' . '';
                } else {
                    $prod->preco = number_format($prod->preco, 2, ',', ' ');
                    echo '' . $prod->preco . ' €';
                }
                ?>
            </div>
            <div style="text-align: right;margin-left: auto;">
                <?php
                if ($prod->quantStock > 0) {
                    echo Html::a('<span class="glyphicon glyphicon-shopping-cart"></span> Adicionar ao Carrinho', ['site/addcarrinho', 'id' => $prod->idProduto], ['class' => 'btn btn-success']);
                } else {
                    echo Html::a('<span class="glyphicon glyphicon-remove"></span> Produto sem Stock', ['view', 'id' => $prod->idProduto], ['class' => 'btn btn-danger']);
                } ?>
            </div>
        </div>
        <div style="margin-top: 7%">
            <h4 style="font-weight: bold">Informações Gerais do produto</h4>
            <?php
            if (is_array($prod->descricaoGeral)) {
                echo '<ul>';
                for ($i = 0; $i < count($prod->descricaoGeral); $i++) {
                    echo '<li>' . $prod->descricaoGeral[$i] . '</li>';
                }
                echo '</ul>';
            } else if ($prod->descricaoGeral != null) {
                echo '<li>' . $prod->descricaoGeral . '</li>';

            } else {
                echo '<h4>Este produto não possui informação geral.</h4>';
            }
            ?>
        </div>

    </div>

<div class="img-viewProduto">
    <img class="card-img-top" src=<?= Url::to('@web/Imagens/') . $prod->fotoProduto ?> alt="No image">
    <div>
        <?php
        switch ($isfavorito) {
            case 'favorito':
                echo Html::a('<span class="glyphicon glyphicon-heart" style="color:red; font-size: 100%;"></span><span class="product_favoritos_text"> Remover dos Favoritos</span>', ['favorito/deletefavorito', 'id' => $prod->idProduto]);
                break;
            case'notFavorito':
                echo Html::a('<span class="glyphicon glyphicon-heart" style="color: gray; font-size: 100%;"></span><span class="product_favoritos_text"> Adicionar aos Favoritos</span>', ['favorito/newfavorito', 'id' => $prod->idProduto]);
                break;
            case 'Guest':
                echo Html::a('<span class="glyphicon glyphicon-heart" style="color: gray; font-size: 100%;"></span><span class="product_favoritos_text"> Adicionar aos Favoritos</span>', ['site/login']);
                break;
            default:
                echo 'Erro';
        } ?>
    </div>
</div>
</div>
<div class="product_descricao">
    <h2>Descrição do Produto</h2>
    <p><?= $prod->descricao ?></p>
</div>

</div>

