<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\ContactoForm */

$this->title = 'Update Contacto Form: ' . $model->idContacto;
$this->params['breadcrumbs'][] = ['label' => 'Contacto Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idContacto, 'url' => ['view', 'id' => $model->idContacto]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="contacto-form-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
