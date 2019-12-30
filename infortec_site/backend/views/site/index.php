<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $vendas backend\controllers\SiteController */
/* @var $produtos backend\controllers\SiteController */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <h2>Dia: <?=$vendas['data']?></h2>
    <h4>Income do mes: <?=number_format($vendas['vendas'], 2)?> €</h4>

    <div class="seccao">
        <div class="selecao">
            <h4>Gerir Vendas</h4>
            <div class="cart">
                <div class="item">
                    <?= Html::a('<span style="font-size: 500%; color: #2b20f5;"  class="glyphicon glyphicon-list-alt"></span><br>
                    <span style="color: black">Gerir vendas deste mês</span>', ['vendas/view', 'mes' => Yii::$app->formatter->asDate('now', 'MM')]) ?>
                </div>
                <div class="item">
                    <?= Html::a('<span style="font-size: 500%; color: #2b20f5;"  class="glyphicon glyphicon-calendar"></span><br>
                    <span style="color: black">Gerir vendas por mês</span>', ['vendas/index'])?>
                </div>

            </div>
        </div>
        <div class="selecao">
            <h4>Gerir Produto</h4>
            <div class="cart">
                <div class="item">
                    <?= Html::a('<span style="font-size: 500%; color: #2b20f5;" class="glyphicon glyphicon-eye-open"></span><br>
                    <span style="color: black">Visualizar Produto</span>', ['produto/index']) ?>
                </div>
                <div class="item">
                    <?= Html::a('<span style="font-size: 500%; color: #2b20f5;" class="glyphicon glyphicon-plus"></span><br>
                    <span style="color: black">Criar novo Produto</span>', ['produto/create']) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="seccao">
        <div class="selecao">
            <h4>Gerir Categorias</h4>
            <div class="cart">
                <div class="item">
                    <?= Html::a('<span style="font-size: 500%; color: #2b20f5;" class="glyphicon glyphicon-eye-open"></span><br>
                    <span style="color: black">Visualizar Categorias</span>', ['categoria/index']) ?>
                </div>
                <div class="item">
                    <?= Html::a('<span style="font-size: 500%; color: #2b20f5;" class="glyphicon glyphicon-plus"></span><br>
                    <span style="color: black">Criar nova Categoria</span>', ['categoria/create']) ?>
                </div>
            </div>
        </div>
        <div class="selecao">
            <h4>Gerir SubCategoria</h4>
            <div class="cart">
                <div class="item">
                    <?= Html::a('<span style="font-size: 500%; color: #2b20f5;" class="glyphicon glyphicon-eye-open"></span><br>
                    <span style="color: black">Visualizar SubCategorias</span>', ['subcategoria/index']) ?>
                </div>
                <div class="item">
                    <?= Html::a('<span style="font-size: 500%; color: #2b20f5;" class="glyphicon glyphicon-plus"></span><br>
                    <span style="color: black">Criar nova SubCategoria</span>', ['subcategoria/create']) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="seccao">
        <div class="selecao">
            <h4>Gerir Indicativos</h4>
            <div class="cart">
                <div class="item">
                    <?= Html::a('<span style="font-size: 500%; color: #2b20f5;" class="glyphicon glyphicon-eye-open"></span><br>
                    <span style="color: black">Visualizar indicativos</span>', ['indicativo/index']) ?>
                </div>
                <div class="item">
                    <?= Html::a('<span style="font-size: 500%; color: #2b20f5;" class="glyphicon glyphicon-plus"></span><br>
                    <span style="color: black">Criar novo indicativo</span>', ['indicativo/create']) ?>
                </div>
            </div>
        </div>
        <div class="selecao">
            <h4>Gerir Utilizador</h4>
            <div class="cart">
                <div class="item">
                    <?= Html::a('<span style="font-size: 500%; color: #2b20f5;"  class="glyphicon glyphicon-eye-open"></span><br>
                    <span style="color: black">Visualizar Utilizador</span>', ['user/index']) ?>
                </div>
            </div>
        </div>
    </div>
</div>