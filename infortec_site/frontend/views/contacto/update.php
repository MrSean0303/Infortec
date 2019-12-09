<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\ContactoForm */

$this->title = 'Alterar Contacto de ' . $model['contacto']->utilizador_id;
$this->params['breadcrumbs'][] = ['label' => 'Dados User', 'url' => ['user/index']];
$this->params['breadcrumbs'][] = ['label' => 'Contactos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model['contacto']->numero, 'url' => ['view', 'id' => $model['contacto']->idContacto]];
$this->params['breadcrumbs'][] = 'Alterar';
?>

<div class="contacto-form-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model['contacto'], 'indicativo_id')->dropdownList(ArrayHelper::map($model['indicativo'], 'idIndicativo', 'pais'),
        ['options' => [$model['contacto']->indicativo_id => ['Selected'=>'selected']]])
        ->label('Pais'); ?>

    <?= $form->field($model['contacto'], 'numero')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
