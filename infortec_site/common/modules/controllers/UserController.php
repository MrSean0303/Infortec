<?php

namespace common\modules\controllers;

use common\models\User;
use common\models\Utilizador;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii;

/**
 * Default controller for the `api` module
 */
class UserController extends \yii\rest\ActiveController
{
    public $modelClass = 'common\models\User';

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['verbs'] =[
            'class' => VerbFilter::className(),
            'actions' => [
                'Edit' => 'PUT',
                'Changepassword' => 'PUT',
                'Registar' => 'POST'
            ],
        ];

        return $behaviors;
    }

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }

    public function actionIndex()
    {
        $request = yii::$app->request;
        $credentials = $request->getAuthCredentials();
        $username = $credentials[0];
        $password = $credentials[1];

        $user = $this->auth($username, $password);
        if ($user != null){
            $utilizador = Utilizador::find()->where(['user_id' => $user->id])->one();

            return [
                'id' => $user->id,
                'username' => $user->username,
                'nome' => $utilizador->nome,
                'email' => $user->email,
                'status' => $user->status,
                'role' => $user->role,
                'nif' => $utilizador->nif,
                'morada' => $utilizador->morada,
                'numPontos' => $utilizador->numPontos
            ];
        }else{
            Throw new BadRequestHttpException("User não encontrado");
        }


    }

    public function actionEdit()
    {
        $request = yii::$app->request;
        $credentials = $request->getAuthCredentials();
        $username = $credentials[0];
        $password = $credentials[1];

        $user = $this->auth($username, $password);
        if ($user != null){
            $user = User::find()->where(['id' =>yii::$app->user->id ])->one();
            $utilizador = Utilizador::find()->where(['user_id' => $user->id])->one();

            $user->email = yii::$app->request->getBodyParam("email");
            $utilizador->nif = yii::$app->request->getBodyParam("nif");
            $utilizador->morada = yii::$app->request->getBodyParam("morada");
            $utilizador->nome = yii::$app->request->getBodyParam("nome");

            if ($user->save() && $utilizador->save()){
                return 1;
            }else{
                Throw new BadRequestHttpException("Erro na edição do Utilizador");
            }
        }else{
            Throw new BadRequestHttpException("O user não foi encontrado");
        }
    }

    public function actionChangepassword()
    {
        $request = yii::$app->request;
        $credentials = $request->getAuthCredentials();
        $username = $credentials[0];
        $password = $credentials[1];

        $user = $this->auth($username, $password);
        if ($user != null) {
            $user->setPassword(yii::$app->request->getBodyParam("password"));
        } else {
            Throw new BadRequestHttpException("password incorreta");
        }
    }

    public function actionRegistar(){

        $user = new User();
        $utilizador = new Utilizador();

        $utilizador->nome =  yii::$app->request->getBodyParam("nome");
        $user->username = yii::$app->request->getBodyParam("username");
        $user->email = yii::$app->request->getBodyParam("email");
        $utilizador->morada = yii::$app->request->getBodyParam("morada");
        $utilizador->nif = yii::$app->request->getBodyParam("nif");
        $user->setPassword(yii::$app->request->getBodyParam("password"));
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $utilizador->cargo = 0;
        $utilizador->numPontos = 0;
        if ($user->save()){
            $utilizador->user_id = $user->id;
            if (!$utilizador->save()){
                Throw new BadRequestHttpException("Erro na criação do Utilizador");
            }
            return $user->id;
        }else{
            Throw new BadRequestHttpException("Erro na criação do User");
        }

    }

    public function auth($username, $password)
    { $user = User::findByUsername($username);
        if ($user && $user->validatePassword($password)) {
            return $user;
        }
        return null;
    }


}

