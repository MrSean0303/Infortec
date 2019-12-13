<?php

use yii\helpers\Html;

/* @var $vendasMes\backend\controllers\VendasController */


$this->title = 'Vendas por Mes';
$this->params['breadcrumbs'][] = $this->title;
?>

    <h1 style="text-align: center">Income realizado por mês</h1>

<?php
if ($vendasMes != null){
    ?>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col">Mês</th>
            <th scope="col">Produtos Vendidos</th>
            <th scope="col">Lucro</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($vendasMes as $venda){
            echo '<tr>';
            echo '<td scope="row">'. $venda->produto_id.'</td>';
            echo '<td>'. $venda->quantidade.'</td>';
            echo '<td style="text-align: right">'.number_format($venda->precoProduto, 2,",",".").' €</td>';
            echo '<td style="width: 10%;  text-align: center" >' . Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['vendas/view', 'mes' => $venda->mes]). '</td>';
            echo '</tr>';
        }
        ?>
        </tbody>
    </table>

    <?php
}else{
    echo '<br>';
    echo '<h4 style="text-align: center">Não teve lucros este mês</h4>';
}