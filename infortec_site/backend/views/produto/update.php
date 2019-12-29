<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Produto */
/* @var $subcategoria \backend\controllers\ProdutoController */
/* @var $iva \backend\controllers\ProdutoController */

$this->title = 'Update Produto: ' . $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Produtos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idProduto, 'url' => ['view', 'id' => $model->idProduto]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="produto-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model, 'iva' => $iva, 'subcategoria' => $subcategoria
    ]) ?>

</div>
