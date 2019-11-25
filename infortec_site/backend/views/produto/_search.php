<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProdutoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="produto-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idProduto') ?>

    <?= $form->field($model, 'nome') ?>

    <?= $form->field($model, 'fotoProduto') ?>

    <?= $form->field($model, 'descricao') ?>

    <?= $form->field($model, 'descricaoGeral') ?>

    <?php // echo $form->field($model, 'preco') ?>

    <?php // echo $form->field($model, 'quantStock') ?>

    <?php // echo $form->field($model, 'valorDesconto') ?>

    <?php // echo $form->field($model, 'pontos') ?>

    <?php // echo $form->field($model, 'subCategoria_id') ?>

    <?php // echo $form->field($model, 'iva_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
