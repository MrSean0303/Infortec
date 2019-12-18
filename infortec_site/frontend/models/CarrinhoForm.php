<?php

namespace frontend\models;

use common\models\Produto;
use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class CarrinhoForm extends Model
{
    public $idProduto;
    public $nome;
    public $fotoProduto;
    public $quantStock;
    public $preco;
    public $valorDesconto;
    public $quantidade;
    public $precofinal;

    public function rules()
    {
        return [
            //[['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
            [['nome', 'preco', 'quantStock', 'subCategoria_id'], 'required'],
            [['nome', 'fotoProduto'], 'string'],
            [['preco', 'valorDesconto', 'precofinal'], 'number'],
            [['quantStock', 'quantidade'], 'integer'],
            [['nome', 'fotoProduto'], 'string', 'max' => 255],
            [['fotoProduto'], 'unique'],
            ];
    }

    public function addToCart($id){
        $cookies = Yii::$app->request->cookies;
        $carrinho = $cookies->getValue('carrinho');

        if ($carrinho == null) {
            $carrinho = array([
                'id' => $id,
                'quant' => 1,
            ]);
        }else{
            $isArrayAlreadyExists = false;
            for ($i=0; $i < sizeof($carrinho); $i++){
                if ($carrinho[$i]['id'] == $id && Yii::$app->request->post('quantidade') == null){
                    $carrinho[$i]['quant'] += 1;
                    $isArrayAlreadyExists = true;
                }elseif ($carrinho[$i]['id'] == $id && Yii::$app->request->post('quantidade') != null){
                    $quantidade = Yii::$app->request->post('quantidade');
                    if ($quantidade < 1){
                        $quantidade = 1;
                    }
                    $carrinho[$i]['quant'] = $quantidade;
                    $isArrayAlreadyExists = true;
                }
            }

            if (!$isArrayAlreadyExists){
                $produto =[
                    'id' => $id,
                    'quant' => 1,
                ];

                array_push($carrinho, $produto);
            }
        }

        $newCookies = Yii::$app->response->cookies;
        $newCookies->remove('carrinho');
        $newCookies->add(new \yii\web\Cookie([
            'name' => 'carrinho',
            'value' => $carrinho,
        ]));

        return $carrinho;
    }

    public function deleteFromCart($id){
        $cookies = Yii::$app->request->cookies;
        $carrinho = $cookies->getValue('carrinho');


        for ($i=0; $i< sizeof($carrinho); $i++){
            if ($carrinho[$i]['id'] == $id){
                array_splice($carrinho, $i,1);
            }
        }
        $newCookies = Yii::$app->response->cookies;
        $newCookies->remove('carrinho');
        $newCookies->add(new \yii\web\Cookie([
            'name' => 'carrinho',
            'value' => $carrinho,
        ]));

        return $carrinho;
    }

    public function getCart($cartCookie){

        for ($i=0; $i< sizeof($cartCookie); $i++){
            $prod = Produto::find()->where(['idProduto' => $cartCookie[$i]['id']])->one();
            $cartProd = new CarrinhoForm();

            $cartProd->idProduto = $prod->idProduto;
            $cartProd->nome = $prod->nome;
            $cartProd->fotoProduto = $prod->fotoProduto;
            $cartProd->preco = $prod->preco;
            $cartProd->quantidade = $cartCookie[$i]['quant'];
            $cartProd->quantStock = $prod->quantStock;
            $cartProd->valorDesconto = $prod->valorDesconto;

            if ($cartProd->valorDesconto != null){
                $cartProd->precofinal = ($cartProd->preco - $cartProd->valorDesconto) * $cartProd->quantidade;
            }else{
                $cartProd->precofinal = $cartProd->preco * $cartProd->quantidade;
            }

            $cart[$i] = $cartProd;
        }

        return $cart;
    }
}
