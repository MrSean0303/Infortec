<?php

/* @var $this \yii\web\View */
/* @var $content string */

use common\models\Categoria;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']]];
    $menuItems[] = [
        'label' => 'Sobre Nós',
        'items' => [
            ['label' => 'About', 'url' => ['/site/about']],
            ['label' => 'Contact', 'url' => ['/site/contact']],
        ],
    ];

    $menuItems[] = [
        'label' => 'Categorias',
        'items' => [
            ['label' => 'Computadores',
                'items' => [['label' => 'Fixo', 'url' => ['/site/categoriafixo']],
                    ['label' => 'Portatil', 'url' => ['/site/categoriaportatil']]], 'url' => ['/site/index'], 'options'=> ['class'=>'testeREE']],
            '<li class="divider"></li>',
            ['label' => 'Componentes', 'url' => ['/site/contact']],
        ],
    ];
    $menuItems[] = ['label' => '<span class="glyphicon glyphicon-shopping-cart"></span>', 'url' => ['/site/carrinho'], 'encode'=>false];

    /*
         $menuItems[] = [
        'label' => 'Categorias',
        'items' => [
            ['label' => 'Computadores',
                'items' => [['label' => 'Fixo', 'url' => ['/site/categoriafixo']],
                    ['label' => 'Portatil', 'url' => ['/site/categoriaportatil']]], 'url' => ['/site/index'], 'options'=> ['class'=>'testeREE']],
            '<li class="divider"></li>',
            ['label' => 'Componentes', 'url' => ['/site/contact']],
        ],
    ];

     */

    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = ['label' => '<span class="glyphicon glyphicon-heart"></span>', 'url' => ['/favorito/index'],'encode'=>false];
        $menuItems[] = ['label' => '<span class="glyphicon glyphicon-user"></span>', 'url' => ['/user/index'], 'encode'=>false];
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';

    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'items' => $menuItems,
    ]);

    $controllerl = Yii::$app->controller;
    $homecheker = $controllerl->id.'/'.$controllerl->action->id;

    if($homecheker=='site/index' || $homecheker=='site/searchproducts')
    {
        echo '<form class="form-inline my-2 my-lg-0" style="float: right !important; padding: 8px !important;" action="'. Url::toRoute("searchproducts") .'">';
        echo '<input class="form-control mr-sm-2" name="pesquisa" type="search" placeholder="Pesquisar" aria-label="Search" onfocus="this.placeholder = \'\', this.style.transition=\'0.5s\', this.style.width=\'350px \'" onblur="this.placeholder = \'Pesquisar\', this.style.transition=\'0.5s\', this.style.width=\'250px\'" style ="width: 250px !important;">';
        echo '</form>';
    }

    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
