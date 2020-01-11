<?php

namespace common\modules\controllers;

use common\models\Linhavenda;
use common\models\User;
use common\models\Venda;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii;

class LinhavendaController extends \yii\rest\ActiveController
{
    public $modelClass = 'common\models\Linhavenda';

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
                'add' => 'POST'
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

        $linhaCompleta[] = null;

        foreach ($vend as $vendas){
            $linha = Linhavenda::find()->where(['venda_id' => $vendas->idVenda])->all();

            array_push($linhaCompleta, $linha);
        }


        return $linhaCompleta;
    }

    public function actionView($id)
    {
        $vend = Venda::find()->where(['idVenda' => $id, 'utilizador_id' => yii::$app->user->id])->one();
        if ($vend != null){
            $linha = Linhavenda::find()->where(['venda_id' => $vend->idVenda])->all();
            return $linha;
        }
            Throw new BadRequestHttpException("Venda não exite");

    }

    public function actionAdd()
    {
        $linha = new Linhavenda();

        $linha->quantidade = yii::$app->request->getBodyParam("quantidade");
        $linha->preco = yii::$app->request->getBodyParam("preco");
        $linha->venda_id = yii::$app->request->getBodyParam("venda_id");
        $linha->produto_id = yii::$app->request->getBodyParam("produto_id");

        if ($linha->preco == 0) {
            $linha->isPontos = 100;
        } else {
            $linha->isPontos = null;
        }

        if ($linha->save()) {
            return $linha;
        } else {
            Throw new BadRequestHttpException("Erro na criação da linha de venda");
        }
    }
}
