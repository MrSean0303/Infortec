<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Produto */
/* @var  $iva backend\controllers\ProdutoController */
/* @var $subcategoria backend\controllers\ProdutoController*/

$this->title = 'Create Produto';
$this->params['breadcrumbs'][] = ['label' => 'Produtos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="produto-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model, 'iva' => $iva, 'subcategoria' => $subcategoria,
    ]) ?>

</div>
