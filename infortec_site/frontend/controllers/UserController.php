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

        return $this->render('index', ['model' => $model]);
    }

    public function actionEdituser()
    {
        $user = User::findIdentity(Yii::$app->user->id);
        $utilizador = Utilizador::find()->where(['user_id' => $user->id])->one();

        $model = new UserForm();

        /*$indicativos = Indicativo::find()->all();
        $contactos = Contacto::find()->where(['utilizador_id' => $utilizador->idUtilizador])->all();*/

        if ($model->load(Yii::$app->request->post()) && $model->editUser()) {
            Yii::$app->session->setFlash('success', 'Dados Alterados com sucesso');
            $model->pontos = $utilizador->numPontos;
            return $this->render('index', ['model' => $model]);
        }else{
            $model ->username = $user->username;
            $model->nome = $utilizador->nome;
            $model->email = $user->email;
            $model->morada = $utilizador->morada;
            $model->nif = $utilizador->nif;
            $model->pontos = $utilizador->numPontos;
            return $this->render('Edituser', ['model' => $model]);
        }

    }

}
