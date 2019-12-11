<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Produto */
/* @var $iva backend\controllers\ProdutoController */
/* @var $subcategoria backend\controllers\ProdutoController */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="produto-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <!-- $form->field($model, 'imageFile')->fileInput() -->

    <?= $form->field($model, 'fotoProduto')->textInput() ?>

    <?= $form->field($model, 'descricao')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'preco')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'quantStock')->textInput() ?>

    <?= $form->field($model, 'valorDesconto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pontos')->textInput() ?>

    <?= $form->field($model, 'subCategoria_id')->dropdownList(ArrayHelper::map($subcategoria, 'idsubCategoria', 'nome'),
        [
            'prompt' => 'Selecione...'
        ])->label('Categoria')?>

    <?= $form->field($model, 'iva_id')->dropdownList(ArrayHelper::map($iva, 'idIva', 'valorIva'),
        [
            'prompt' => 'Selecione...'
        ])->label('Valor do iva')?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
