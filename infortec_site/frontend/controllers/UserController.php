<?php

namespace frontend\controllers;


use frontend\models\UserForm;
use Yii;
use common\models\User;
use common\models\Utilizador;
use \yii\web\Controller;

class UserController extends Controller
{

    public function actionIndex(){
        $user = User::findIdentity(Yii::$app->user->id);
        $utilizador = Utilizador::find()->where(['user_id' => $user->id])->one();

        $model  = new UserForm();

        $model ->username = $user->username;
        $model->nome = $utilizador->nome;
        $model->email = $user->email;
        $model->morada = $utilizador->morada;
        $model->nif = $utilizador->nif;
        $model->pontos = $utilizador->numPontos;

        if($model->nif == null){
            $model->nif = "Não tem";
        }

        return $this->render('index', ['model' => $model]);
    }

    public function actionEdituser()
    {
        $user = User::findIdentity(Yii::$app->user->id);
        $utilizador = Utilizador::find()->where(['user_id' => $user->id])->one();

        $model = new UserForm();

        if ($model->load(Yii::$app->request->post()) && $model->editUser()) {
            Yii::$app->session->setFlash('success', 'Dados Alterados com sucesso');
            $model->pontos = $utilizador->numPontos;
            return $this->render('index', ['model' => $model]);
        }

            $model ->username = $user->username;
            $model->nome = $utilizador->nome;
            $model->email = $user->email;
            $model->morada = $utilizador->morada;
            $model->nif = $utilizador->nif;
            $model->pontos = $utilizador->numPontos;
            return $this->render('Edituser', ['model' => $model]);
    }

    public function actionChange_password()
    {
        $model = new UserForm();
        $user = User::findIdentity(Yii::$app->user->id);
        $utilizador = Utilizador::find()->where(['user_id' => $user->id])->one();



        if ($model->load(Yii::$app->request->post()) && $user->validatePassword($model->oldpassword)){
            $user->setPassword($model->password);
            $user->save();
            Yii::$app->session->setFlash('success', 'Palavra passe alterada com sucesso');
            $model ->username = $user->username;
            $model->nome = $utilizador->nome;
            $model->email = $user->email;
            $model->morada = $utilizador->morada;
            $model->nif = $utilizador->nif;
            $model->pontos = $utilizador->numPontos;
            return $this->render('index', ['model' => $model]);
        }

        return $this->render('changepassword', ['model' => $model]);
    }
}
