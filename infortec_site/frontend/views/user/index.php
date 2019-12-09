<?php


use yii\helpers\Html;

/* @var $model frontend\models\UserForm */

?>
<h1 style="text-align: center">Dados do Utilizador</h1>

<div class="userIndex_body">
    <table class="table table" style="margin-top: 2%">
        <tbody>
        <tr>
            <td scope="row">Nome Proprio</td>
            <td> <?=$model->nome?></td>
        </tr>
        <tr>
            <td scope="row">Username</td>
            <td><?=$model->username?></td>
        </tr>
        <tr>
            <td scope="row">Email</td>
            <td><?=$model->email?></td>
        </tr>
        <tr>
            <td scope="row">Nif</td>
            <td><?=$model->nif?></td>
        </tr>
        <tr>
            <td scope="row">Numero de Pontos</td>
            <td><?=$model->pontos?></td>
        </tr>
        </tbody>
    </table>

    <?= Html::a('Change password', ['user/change_password'], ['class' => 'btn btn-primary']) ?>

    <hr>
    <?= Html::a('Visualizar Conctatos', ['contacto/index'], ['class' => 'btn btn-success']) ?>

    <?= Html::a('Alterar dados do Utilizado', ['edituser'], ['class' => 'btn btn-success']) ?>

</div>
