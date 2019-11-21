<?php

namespace backend\controllers;

class ProdutoController extends \yii\web\Controller
{
    public function actionProdutos()
    {
        return $this->render('produtos');
    }

}
