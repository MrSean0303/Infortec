<?php

use frontend\controllers\ProdutoController;
use yii\bootstrap\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $prod ProdutoController*/
/* @var $isfavorito ProdutoController*/

$img = Url::to('@web/Imagens/').$prod->fotoProduto;

$this->title = $prod->nome;
?>
        <div style="width: 90%; display: inline-block">
            <div class="img-viewProduto">
                <img class="card-img-top" src=<?=Url::to('@web/Imagens/').$prod->fotoProduto ?> alt="No image">
            </div>

            <div class="product_informacaoLadoImagem">
                <div>
                    <h1><?=$prod->nome?></h1>
                </div>
                <div>
                    <?php
                    if ($prod->valorDesconto > 0 ){
                        $a = $prod->preco - $prod->valorDesconto;
                        $prod->preco = number_format($prod->preco, 2, ',', ' ');
                        $a = number_format($a, 2, ',', ' ');
                        echo '<h4><strike>'. $prod->preco.'€</strike>'. ' ' .$a .' €'.'</h4>';
                    }else {
                        $prod->preco = number_format($prod->preco, 2, ',', ' ');
                        echo '<h4>'.$prod->preco.' €</h4>';
                    }
                    ?>
                </div>
                <div>
                    <p><?=$prod->descricao?></p>
                </div>
                <div style="display: flex; width: 100%">
                    <div style="font-size: 200%">
                        <?php
                        switch ($isfavorito){
                            case 'favorito':
                                echo Html::a('<span class="glyphicon glyphicon-heart" style="color:red"></span>', [ 'favorito/deletefavorito', 'id' => $prod->idProduto]);
                                break;
                            case 'notFavorito':
                                echo Html::a('<span class="glyphicon glyphicon-heart" style="color: gray"></span>', [ 'favorito/newfavorito', 'id' => $prod->idProduto]);
                                break;
                            case 'Guest':
                                echo Html::a('<span class="glyphicon glyphicon-heart" style="color: gray"></span>', [ 'site/login']);
                                break;
                            default:
                                echo 'Erro';
                        }
                            ?>
                    </div>
                    <div style="text-align: right;margin-left: auto">
                        <?php
                        if($prod->quantStock >0){
                            echo Html::a('<span class="glyphicon glyphicon-shopping-cart"></span> Adicionar ao Carrinho', ['site/addcarrinho', 'id' =>$prod->idProduto], ['class' => 'btn btn-success']);
                        }else{
                           echo Html::a('<span class="glyphicon glyphicon-remove"></span> Produto sem Stock', ['view' , 'id' =>$prod->idProduto], ['class' => 'btn btn-danger']);
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div style="">
            <h4>Informações Gerais do produto</h4>
            <?php
                if(is_array($prod->descricaoGeral)) {
                    echo '<ul>';
                    for ($i = 0; $i < count($prod->descricaoGeral); $i++) {
                        echo '<li>' . $prod->descricaoGeral[$i] . '</li>';
                    }
                    echo '</ul>';
                }else if ($prod->descricaoGeral != null){
                    echo '<p>' . $prod->descricaoGeral . '</p>';

                }else{
                    echo '<h4>Este produto não possui informação geral.</h4>';
                }
                ?>
        </div>

