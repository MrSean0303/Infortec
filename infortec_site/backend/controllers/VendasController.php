<?php
namespace backend\controllers;

use Yii;
use DateTime;
use backend\models\GerirVendaForm;
use common\models\Linhavenda;
use common\models\Produto;
use common\models\Venda;
use yii\web\Controller;

class VendasController extends Controller{

    public function actionIndex()
    {
        $vendasPorMes = null;
        $vendas = Venda::find()->all();
        $monthAlreadyExists = false;

        if(empty($vendas) != true) {
            foreach ($vendas as $venda) {
                for ($i = 1; $i <= 12; $i++) {
                    if (Yii::$app->formatter->asDate($venda->data, 'MM') == $i) {
                        $linhas = Linhavenda::find()->where(['venda_id' => $venda->idVenda])->all();
                        $totalprodutos= 0;
                        foreach ($linhas as $linha){
                            $totalprodutos += $linha->quantidade;
                        }

                        if ($vendasPorMes == null) {
                            $vendasPorMes[] = new GerirVendaForm();
                            $vendasPorMes[0]->quantidade = $totalprodutos;
                            $vendasPorMes[0]->precoProduto = $venda->totalVenda;
                            $vendasPorMes[0]->mes = $i;

                            $dateObj   = DateTime::createFromFormat('!m', $i);
                            $vendasPorMes[0]->produto_id = $dateObj->format('F');

                        } else {
                            foreach ($vendasPorMes as $vendames) {
                                if ($vendames->mes == $i) {
                                    $vendames->precoProduto += $venda->totalVenda;
                                    $monthAlreadyExists = true;
                                }
                            }
                            if ($monthAlreadyExists == false) {
                                $vend = new GerirVendaForm();
                                $vend->quantidade = $totalprodutos;
                                $vend->precoProduto += $venda->totalVenda;
                                $vend->mes = $i;

                                $dateObj   = DateTime::createFromFormat('!m', $i);
                                $vend->produto_id = $dateObj->format('F');

                                array_push($vendasPorMes, $vend);
                            }
                            $monthAlreadyExists = false;
                        }
                    }
                }
            }
        }
        //Organizar array por meses
        for ($j = 0; $j < count($vendasPorMes) ; $j++) {
            for ($k = $j + 1; $k < count($vendasPorMes); $k++) {
                if ($vendasPorMes[$j]->mes > $vendasPorMes[$k]->mes) {
                    $temp = $vendasPorMes[$j];
                    $vendasPorMes[$j] = $vendasPorMes[$k];
                    $vendasPorMes[$k] = $temp;
                }
            }
        }

        return $this->render('index', ['vendasMes' => $vendasPorMes]);
    }

    public function actionView($mes)
    {
        $vendas = Venda::find()->all();
        $is_venda = false;
        $numeroVenda = null;
        $totalGanho =0;

        $dateObj   = DateTime::createFromFormat('!m', $mes);


        if(empty($vendas) != true){
            foreach ($vendas as $venda){
                if(Yii::$app->formatter->asDate($venda->data, 'MM') == $mes) {
                    $linhaVenda = Linhavenda::find()->where(['venda_id' => $venda->idVenda])->all();
                    foreach ($linhaVenda as $linha){
                        if ($numeroVenda != null) {
                            foreach ($numeroVenda as $venda) {
                                if ($venda->produto_id == $linha->produto_id) {
                                    $venda->precoProduto += ($linha->quantidade * $linha->preco);
                                    $venda->quantidade += $linha->quantidade;
                                    $is_venda = true;

                                }
                            }
                            if ($is_venda == false) {
                                $produto = Produto::find()->where(['idProduto' => $linha->produto_id])->one();

                                $venda = new GerirVendaForm();

                                $venda->nomeProduto = $produto->nome;
                                $venda->precoProduto = ($linha->quantidade * $linha->preco);
                                $venda->quantidade = $linha->quantidade;
                                $venda->produto_id = $linha->produto_id;

                                array_push($numeroVenda, $venda);
                            }
                        }else{
                            $produto = Produto::find()->where(['idProduto' => $linha->produto_id])->one();
                            $numeroVenda[] = new GerirVendaForm();

                            $numeroVenda[0]->nomeProduto = $produto->nome;
                            $numeroVenda[0]->precoProduto = ($linha->quantidade * $linha->preco);
                            $numeroVenda[0]->quantidade = $linha->quantidade;
                            $numeroVenda[0]->produto_id = $linha->produto_id;
                        }
                        $is_venda=false;
                    }
                }
            }


            foreach ($numeroVenda as $vendas){
                $totalGanho += $vendas->precoProduto;
            }
        }
        $mes = $dateObj->format('F');

        return $this->render('viewMes', ['vendasPorProdutos' => $numeroVenda, 'total' => $totalGanho, 'mes' => $mes]);
    }
}
