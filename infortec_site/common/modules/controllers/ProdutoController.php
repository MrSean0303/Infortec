<?php

namespace common\modules\controllers;

use yii\filters\auth\HttpBasicAuth;
use yii\web\Controller;

/**
 * Default controller for the `api` module
 */
class ProdutoController extends \yii\rest\ActiveController
{
    public $modelClass = 'common\models\Produto';

    public function actionTotal()
    {
        $model = new $this->modelClass;
        $recs = $model::find()->all();
        return ['total' => count($recs)];
    }

    public function actionIndex()
    {
        return 1;
        //return $this->render('index');
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        /*$behaviors['authenticator'] = [
            'class' => HttpBasicAuth::className(),
        ];*/
        return $behaviors;
    }
}
