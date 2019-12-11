<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ContactoForm */
$this->params['breadcrumbs'][] = ['label' => 'Dados User', 'url' => ['user/index']];
$this->params['breadcrumbs'][] = ['label' => 'Contactos', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Criar';

?>
<div class="contacto-form-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model['contacto'], 'indicativo_id')->dropdownList(ArrayHelper::map($model['indicativo'], 'idIndicativo', 'pais'),
        [
                'prompt' => 'Selecione...'
        ])->label('Pais')?>

    <?= $form->field($model['contacto'], 'numero')->label('Numero de Telefone')?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
