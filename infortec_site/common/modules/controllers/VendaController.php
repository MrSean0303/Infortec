<?php

namespace common\modules\controllers;

use common\models\Linhavenda;
use common\models\User;
use common\models\Venda;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
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

        $behaviors['verbs'] =[
            'class' => VerbFilter::className(),
            'actions' => [
                'Createvenda' => 'POST',
                'Linha' => 'POST'
            ],
        ];

        return $behaviors;
    }

    public function actionIndex()
    {
        return 1;
        //return $this->render('index');
    }

    public function actionCreatevenda(){
        $venda = new Venda();

        $venda->totalVenda = yii::$app->request->getBodyParam("total");
        $venda->data = Date( 'Y-m-d h:i:s ');
        $venda->utilizador_id = yii::$app->user->id;
        if ($venda->save()){
            return $venda;
        }else{
            Throw new BadRequestHttpException("Erro na criação da Venda");
        }
    }

    public function actionLinha(){
        $linha = new Linhavenda();

        $linha->quantidade = yii::$app->request->getBodyParam("quantidade");
        $linha->preco = yii::$app->request->getBodyParam("preco");
        $linha->venda_id = yii::$app->request->getBodyParam("venda_id");
        $linha->produto_id = yii::$app->request->getBodyParam("produto_id");

        if ($linha->preco == 0){
            $linha->isPontos = 100;
        }else{
            $linha->isPontos = null;
        }

        if ($linha->save()){
            return $linha;
        }else{
            Throw new BadRequestHttpException("Erro na criação da linha de venda");
        }
    }


}
