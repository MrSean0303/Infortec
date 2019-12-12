<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Indicativo */

$this->title = 'Create Indicativo';
$this->params['breadcrumbs'][] = ['label' => 'Indicativos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="indicativo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
