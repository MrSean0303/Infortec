<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\UserForm */
/* @var $form ActiveForm */

$this->title = "Editar dados do utilizador";
$this->params['breadcrumbs'][] = ['label' => 'Dados User', 'url' => ['user/index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="user-index">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'nome') ?>
        <?= $form->field($model, 'username') ?>
        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'nif') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Alterar dados', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- user-index -->
