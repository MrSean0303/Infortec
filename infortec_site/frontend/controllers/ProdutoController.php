<?php


namespace frontend\controllers;

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

        //formatar preço
        $produtoSelecionado->preco = number_format($produtoSelecionado->preco, 2, ',', ' ');

        //transformar a descrição de componentes numa lista
        if (strpos($produtoSelecionado->descricaoGeral, " |") != false) {
            while (strpos($produtoSelecionado->descricaoGeral, " |") != false) {
                $position = strpos($produtoSelecionado->descricaoGeral, " |");
                $component = substr($produtoSelecionado->descricaoGeral, 0, $position);
                $produtoSelecionado->descricaoGeral = substr($produtoSelecionado->descricaoGeral, $position + 3);
                $componentsList[] = $component;
            }
            $produtoSelecionado->descricaoGeral = $componentsList;
        }

        //Buscar o nome da subcategoria
        $produtoSelecionado->subCategoria_id = $produtoSelecionado->getSubCategoria()->one()->nome;


        var_dump($produtoSelecionado->getIva());
        die();



        return $this->render('view', [
            'prod' => $produtoSelecionado,
        ]);
    }
}