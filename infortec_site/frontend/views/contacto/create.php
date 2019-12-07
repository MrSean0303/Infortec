<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\ContactoForm */

$this->title = 'Create Contacto Form';
$this->params['breadcrumbs'][] = ['label' => 'Contacto Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contacto-form-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
