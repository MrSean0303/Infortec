<?php


namespace frontend\controllers;

use common\models\Subcategoria;
use Yii;
use common\models\Produto;
use yii\filters\VerbFilter;
use yii\web\Controller;

class ProdutoController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionView($id)
    {
        $produtoSelecionado = Produto::findOne($id);
        //transformar a descrição de componentes numa lista
        if (strpos($produtoSelecionado->descricaoGeral, " |") != false) {
            while (strpos($produtoSelecionado->descricaoGeral, " |") != false){
                $position = strpos($produtoSelecionado->descricaoGeral, " |");
                $component = substr($produtoSelecionado->descricaoGeral, 0, $position);
                $produtoSelecionado->descricaoGeral = substr($produtoSelecionado->descricaoGeral, $position + 3);
                $componentsList[] = $component;
            }
            $componentsList[] = $produtoSelecionado->descricaoGeral;

            $produtoSelecionado->descricaoGeral = $componentsList;
        }
        //Buscar o nome da subcategoria e o valor do Iva
        $produtoSelecionado->subCategoria_id = $produtoSelecionado->getSubCategoria()->one()->nome;
        $produtoSelecionado->iva_id = $produtoSelecionado->getIva()->one()->valorIva;


        if (!Yii::$app->user->isGuest) {
            $isFavorito = $produtoSelecionado->getFavoritos()->where(['utilizador_id' => Yii::$app->user->id])->one();
            if($isFavorito != null){
                $isFavorito = 'favorito';
            }else{
                $isFavorito = 'notFavorito';
            }
        }else{
            $isFavorito = "Guest";
        }


        return $this->render('view', [
            'prod' => $produtoSelecionado, 'isfavorito' => $isFavorito,
        ]);
    }
}