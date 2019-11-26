<?php


namespace frontend\controllers;

use Yii;
use common\models\Produto;
use yii\filters\VerbFilter;
use yii\web\Controller;

class ProdutoController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }


    public function actionView($id)
    {
        $produtoSelecionado = Produto::findOne($id);

        return $this->render('view', [
            'model' => $produtoSelecionado,
        ]);
    }
}