<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\ContactoForm */

$this->params['breadcrumbs'][] = ['label' => 'Dados User', 'url' => ['user/index']];
$this->params['breadcrumbs'][] = ['label' => 'Contactos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="contacto-form-view">
    <p>
        <?= Html::a('Alterar contacto', ['update', 'id' => $model['contacto']->idContacto], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Apagar contacto', ['delete', 'id' => $model['contacto']->idContacto], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td scope="row">Bandeira do pais</td>
            <td><?= Html::img('@web/Imagens/icons/'. $model['indicativo']->icon,  ['alt' => 'img', 'width' =>'10%' ])?> </td>
        </tr>
        <tr>
            <td scope="row">Pais</td>
            <td><?=$model['indicativo']->pais?></td>
        </tr>
        <tr>
            <td scope="row">Indicativo</td>
            <td><?=$model['indicativo']->indicativo?></td>
        </tr>
        <tr>
            <td scope="row">Numero</td>
            <td><?=$model['contacto']->numero?></td>
        </tr>
        </tbody>
    </table>



</div>
