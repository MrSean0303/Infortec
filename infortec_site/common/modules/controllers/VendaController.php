<?php

namespace common\modules\controllers;

use common\models\User;
use common\models\Venda;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii;

/**
 * Default controller for the `api` module
 */
class VendaController extends \yii\rest\ActiveController
{
    public $modelClass = 'common\models\Venda';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBasicAuth::className(),
            'auth' => function ($username, $password) {
                $user = User::findByUsername($username);
                if ($user && $user->validatePassword($password)) {
                    return $user;
                }
                return null;
            }
        ];

        $behaviors['verbs'] = [
            'class' => VerbFilter::className(),
            'actions' => [
                'Createvenda' => 'POST',
            ],
        ];

        return $behaviors;
    }

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index'], $actions['view']);
        return $actions;
    }


    public function actionIndex()
    {
        $vend = Venda::find()->where(['utilizador_id' => yii::$app->user->id])->all();
        return $vend;

    }

    public function actionView($id)
    {
        $vend = Venda::find()->where(['idVenda' => $id, 'utilizador_id' => yii::$app->user->id])->all();
        if ($vend != null){
            return $vend;
        }
        Throw new BadRequestHttpException("Venda não exite");

    }

    public function actionCreatevenda()
    {
        $venda = new Venda();

        $venda->totalVenda = yii::$app->request->getBodyParam("total");
        $venda->data = Date('Y-m-d h:i:s ');
        $venda->utilizador_id = yii::$app->user->id;
        if ($venda->save()) {
            return $venda;
        } else {
            Throw new BadRequestHttpException("Erro na criação da Venda");
        }
    }
}
