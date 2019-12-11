<?php

namespace common\modules\controllers;

use yii\web\Controller;

/**
 * Default controller for the `api` module
 */
class ProdutoController extends \yii\rest\ActiveController
{
    public $modelClass = 'commmon\models\Produto';
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionTotalProdutos()
    {
        $model = new $this->modelClass;
        $recs = $model::find()->all();
        return ['total' => count($recs)];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
}
