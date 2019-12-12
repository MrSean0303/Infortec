<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Indicativo */

$this->title = 'Update Indicativo: ' . $model->idIndicativo;
$this->params['breadcrumbs'][] = ['label' => 'Indicativos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idIndicativo, 'url' => ['view', 'id' => $model->idIndicativo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="indicativo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
