<?php

use backend\controllers\SubcategoriaController;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Subcategoria */
/* @var $categoria SubcategoriaController */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subcategoria-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'categoria_id')->textInput()->dropdownList(ArrayHelper::map($categoria, 'idCategoria', 'nome'),
        [
            'prompt' => 'Selecione...'
        ])->label('Categoria') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
