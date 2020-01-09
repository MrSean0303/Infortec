<?php

namespace frontend\controllers;

use common\models\Produto;
use frontend\controllers\ProdutoController;
use Yii;
use common\models\Favorito;
use yii\web\Controller;

class FavoritoController extends Controller
{

    public function actionIndex()
    {
        $favoritoList = Favorito::findAll(['utilizador_id' => Yii::$app->user->id,]);

        if (!empty($favoritoList)){
            foreach ($favoritoList as $fav){
                $produtos[] = Produto::findOne(['idProduto' => $fav->produto_id]);
            }
        }else{
            $produtos = null;
        }

        return $this->render('index', [
            'produtos' => $produtos,
        ]);
    }

    public function actionDeletefavorito($id){
        $newFavorito = Favorito::findOne(['utilizador_id' => Yii::$app->user->id, 'produto_id' => $id,]);
        $newFavorito->delete();
        $this->redirect(['produto/view', 'id' => $id]);
    }

    public function actionNewfavorito($id){
        $newFavorito = new Favorito();
        $newFavorito->produto_id = $id;
        $newFavorito->utilizador_id = Yii::$app->user->id;
        $newFavorito->save();
        $this->redirect(['produto/view', 'id' => $id]);
    }

}
