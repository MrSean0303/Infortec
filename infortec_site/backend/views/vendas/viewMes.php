<?php

/* @var $vendasPorProdutos \backend\controllers\VendasController */
/* @var $total \backend\controllers\VendasController*/
/* @var $mes \backend\controllers\VendasController*/


$this->title = $mes;
$this->params['breadcrumbs'][] = ['label' => 'Vendas por mes', 'url' => ['vendas/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h1 style="text-align: center">Lucro realizado no mês</h1>

<?php
if ($vendasPorProdutos != null){
?>

<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">Nome do Produto</th>
            <th scope="col">Quantidade Vendida</th>
            <th scope="col">Preço ganho por produto</th>
        </tr>
    </thead>
    <tbody>
    <?php
        foreach ($vendasPorProdutos as $venda){
            echo '<tr>';
            echo '<td scope="row">'. $venda->nomeProduto.'</td>';
            echo '<td style="text-align: center">'.$venda->quantidade.'</td>';
            echo '<td style="text-align: right">'.number_format( $venda->precoProduto, 2,",",".").' €</td>';
            echo '</tr>';
        }
        echo '<tr>';
        echo '<td scope="row" colspan="2" style="text-align: right">Total Ganho: </td>';
        echo '<td style="text-align: right">'.number_format($total, 2,",",".").' €</td>';
        echo '</tr>';
        ?>
    </tbody>
</table>

<?php
  }else{
    echo '<br>';
    echo '<h4 style="text-align: center">Não teve lucros este mês</h4>';
}
?>

