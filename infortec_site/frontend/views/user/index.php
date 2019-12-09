<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $utilizador frontend\controllers\UserController */
/* @var $model frontend\models\UserForm */

?>
<h1 style="text-align: center">Dados do Utilizador</h1>

<div class="userIndex_body">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['disabled' => true])?>
    <?= $form->field($model, 'username')->textInput(['disabled' => true]) ?>
    <?= $form->field($model, 'email')->textInput(['disabled' => true]) ?>
    <?= $form->field($model, 'nif')->textInput(['maxlength'=>9,'style'=>'width:25%', 'disabled' => true]) ?>
    <?= $form->field($model, 'pontos')->textInput(['maxlength'=>9,'style'=>'width:25%', 'disabled' => true]) ?>
    <?php ActiveForm::end(); ?>

    <hr>
    <?= Html::a('Visualizar Conctatos', ['contacto/index'], ['class' => 'btn btn-success']) ?>

    <?= Html::a('Alterar dados do Utilizado', ['edituser'], ['class' => 'btn btn-success']) ?>

</div>
