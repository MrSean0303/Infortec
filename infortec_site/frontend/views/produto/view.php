<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Produto */

$this->title = $model->idProduto;
$this->params['breadcrumbs'][] = ['label' => 'Produtos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="produto-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idProduto',
            'nome',
            'fotoProduto',
            'descricao:ntext',
            'descricaoGeral:ntext',
            'preco',
            'quantStock',
            'valorDesconto',
            'pontos',
            'subCategoria_id',
            'iva_id',
        ],
    ]) ?>

</div>
