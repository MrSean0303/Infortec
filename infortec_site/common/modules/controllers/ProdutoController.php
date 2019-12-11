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
    public function actionIndex()
    {
        return $this->render('index');
    }
}
