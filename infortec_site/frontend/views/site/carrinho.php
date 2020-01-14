<?php

/* @var $compras \frontend\controllers\SiteController */
/* @var $total \frontend\controllers\SiteController */

use yii\helpers\url;
use yii\helpers\Html;
use yii\widgets\Pjax;

$this->title = "Carrinho de compras"
?>

<h1>Seu Carrinho</h1>

<?php
if ($compras != null) {
?>
    <table class="table">
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Nome do produto</th>
                <th scope="col">Preço</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Preço Final</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($compras as $comp){ ?>
                <tr>
                    <th scope="row" style="width: 10%"><img class="card-img-top" src=<?= Url::to('@web/Imagens/').$comp->fotoProduto ?> alt = "Card image cap"></th>
                    <td><?=Html::a($comp->nome,['produto/view', 'id' => $comp->idProduto])?></td>
                    <td><?php
                        if ($comp->valorDesconto == null || $comp->valorDesconto <= 0){
                            echo number_format($comp->preco, 2,",",".").' €';
                        }else{
                            $newPrice = $comp->preco - $comp->valorDesconto;
                            echo '<strike>'.number_format($comp->preco, 2,",",".").'€</strike><br>'
                                .number_format($newPrice, 2,",",".").' €';
                        }
                        ?>
                    </td>
                    <?php Pjax::begin();
                    echo Html::beginForm(['site/addcarrinho', 'id' => $comp->idProduto], 'post', ['data-pjax' => '', 'class' => 'form-inline']);
                    echo '<td>'.Html::input('integer', 'quantidade', $comp->quantidade, ['class' => 'form-control']).'</td>';
                    echo Html::endForm();
                    Pjax::end(); ?>
                    <td><?=$comp->precofinal?> €</td>

                    <td><?= Html::a('<span style="color: red" class="glyphicon glyphicon-remove"></span>', ['site/deletecarrinho', 'id' => $comp->idProduto])?></td>
                </tr>
            <?php }?>
           <tr>
               <td scope="row" colspan="4" style="text-align: right"><h4>Preço Total:</h4></td>
               <?= '<td style="text-align: right"><h4>'.number_format($total, 2,",",".").' € </h4></td>'?>
           </tr>
        </tbody>
    </table>
    <?php
    echo '<div style="text-align: right">';
    echo Html::a('Finalizar Compra', ['site/vender', 'total' => $total], ['class' => 'btn btn-success']);
    echo '</div>';

}else{
    echo '<h4 style="text-align: center">Ainda não tem produtos adicionados ao carinho.</h4>';
    echo '<p style="text-align: center">Clique '. Html::a('Aqui', ['site/index']).' para visualizar os nosso produtos.</p>';
}
?>