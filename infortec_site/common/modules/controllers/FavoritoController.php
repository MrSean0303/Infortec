<?php

namespace common\modules\controllers;

use common\models\Favorito;
use common\models\User;
use yii\filters\auth\HttpBasicAuth;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii;
use function GuzzleHttp\Psr7\get_message_body_summary;


/**
 * Default controller for the `api` module
 */
class FavoritoController extends \yii\rest\ActiveController
{
    public $modelClass = 'common\models\Favorito';

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
                'Add' => 'POST',
                'Remove' => 'DELETE',
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
        $fav = Favorito::find()->where(['utilizador_id' =>yii::$app->user->id])->all();

        return $fav;
    }

    public function actionView($id)
    {
        $fav = Favorito::find()->where(['idFavorito'=> $id, 'utilizador_id' =>yii::$app->user->id])->one();
        if ($fav != null){
            return $fav;
        }
        Throw new BadRequestHttpException("Favorito não exite");

    }

    public function actionAdd(){
        $favExist = Favorito::find()->where( ['produto_id' => yii::$app->request->getBodyParam("idProduto"), 'utilizador_id' => yii::$app->user->id])->exists();

        if (!$favExist) {
            $fav = new Favorito();
            $fav->utilizador_id = \Yii::$app->user->id;
            $fav->produto_id = yii::$app->request->getBodyParam("idProduto");

            if ($fav->save()) {
                return $fav;
            } else {
                Throw new BadRequestHttpException("Erro na adição aos Favoritos");
            }
        }else{
            Throw new BadRequestHttpException("Produto já existia na lista de favoritos");
        }
    }

    public function actionRemove(){

        $favExist = Favorito::find()->where( ['produto_id' => yii::$app->request->getBodyParam("idProduto"), 'utilizador_id' => yii::$app->user->id])->exists();

        $filename = "C:/wamp64/www/Infortec/file.txt";
        file_put_contents($filename, "data: " .yii::$app->request->getBodyParam("idProduto"));
        if ($favExist){
            $fav = Favorito::find()->where(['produto_id' => yii::$app->request->getBodyParam("idProduto"), 'utilizador_id' => Yii::$app->user->id])->one();
            $fav->delete();
            return $this->actionIndex();
        }else{
            Throw new BadRequestHttpException("O produto nao existe na lista de favoritos");
        }


    }


}
