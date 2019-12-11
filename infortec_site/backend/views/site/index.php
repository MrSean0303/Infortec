<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $vendas backend\controllers\SiteController */
/* @var $produtos backend\controllers\SiteController */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <h2>Dia: <?=$vendas['data']?></h2>
    <h4>Income: <?=number_format($vendas['vendas'], 2)?> €</h4>

    <div style="height: 100%; width: 100%">
        <div class="coiso">
            <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span><br><span style="color: black">Visualizar Utilizador</span>', ['user/index']) ?>
        </div>
        <div class="coiso">
            <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span><br><span style="color: black">Visualizar Produto</span>', ['produto/index']) ?>
        </div>
        <div class="coiso">
            <?= Html::a('<span class="glyphicon glyphicon-plus"></span><br><span style="color: black">Criar novo Produto</span>', ['produto/create']) ?>
        </div>
        <div class="coiso">
            <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span><br><span style="color: black">Visualizar Categoria</span>', ['categoria/index']) ?>
        </div>
        <div class="coiso">
            <?= Html::a('<span class="glyphicon glyphicon-plus"></span><br><span style="color: black">Criar nova Categoria</span>', ['categoria/create']) ?>
        </div>
        <div class="coiso">
            <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span><br><span style="color: black">Visualizar SubCategoria</span>', ['subcategoria/index']) ?>
        </div>
        <div class="coiso">
            <?= Html::a('<span class="glyphicon glyphicon-plus"></span><br><span style="color: black">Criar nova SubCategoria</span>', ['subcategoria/create']) ?>
        </div>
        <div class="coiso">
            <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span><br><span style="color: black">Visualizar Indicativos</span>', ['indicativo/index']) ?>
        </div>
        <div class="coiso">
            <?= Html::a('<span class="glyphicon glyphicon-plus"></span><br><span style="color: black">Criar novo Indicativos</span>', ['indicativo/create']) ?>
        </div>
    </div>


</div>
