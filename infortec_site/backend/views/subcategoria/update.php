<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Subcategoria */
/* @var $categoria backend\controllers\SubcategoriaController */

$this->title = 'Update Subcategoria: ' . $model->idsubCategoria;
$this->params['breadcrumbs'][] = ['label' => 'Subcategorias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idsubCategoria, 'url' => ['view', 'id' => $model->idsubCategoria]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="subcategoria-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model, 'categoria' => $categoria,
    ]) ?>

</div>
