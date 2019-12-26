<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Indicativo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="indicativo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'iconImage')->fileInput() ?>

    <?= $form->field($model, 'pais')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'indicativo')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
