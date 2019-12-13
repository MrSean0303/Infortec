<?php
namespace backend\models;

use common\models\Linhavenda;
use common\models\Produto;
use common\models\Venda;
use Yii;
use yii\base\Model;



class GerirVendaForm extends Model
{
    public $nomeProduto;
    public $precoProduto;
    public $quantidade;
    public $produto_id;
    public $mes;

    public function rules()
    {
        return [
            ['nomeProduto', 'string', 'max' => 255],
            ['precoProduto', 'number'],
            [['quantidade', 'produto_id', 'mes'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nomeProduto' => 'Nome Produto',
            'precoProduto' => 'Preco Produto',
            'quantidade' => 'Quantidade',
            'produto_id' => 'ID venda',
        ];
    }

}