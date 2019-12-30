<?php

namespace frontend\models;

use Yii;
use common\models\Produto;
use common\models\Venda;

/**
 * This is the model class for table "linhavenda".
 *
 * @property int $idlinhaVenda
 * @property int $quantidade
 * @property int $isPontos
 * @property string $preco
 * @property int $venda_id
 * @property int $produto_id
 *
 * @property Produto $produto
 * @property Venda $venda
 */
class LinhavendaForm extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'linhavenda';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['quantidade', 'preco', 'venda_id', 'produto_id'], 'required'],
            [['quantidade', 'isPontos', 'venda_id', 'produto_id'], 'integer'],
            [['preco'], 'number'],
            [['produto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Produto::className(), 'targetAttribute' => ['produto_id' => 'idProduto']],
            [['venda_id'], 'exist', 'skipOnError' => true, 'targetClass' => Venda::className(), 'targetAttribute' => ['venda_id' => 'idVenda']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idlinhaVenda' => 'Idlinha Venda',
            'quantidade' => 'Quantidade',
            'isPontos' => 'Is Pontos',
            'preco' => 'Preco',
            'venda_id' => 'Venda ID',
            'produto_id' => 'Produto ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduto()
    {
        return $this->hasOne(Produto::className(), ['idProduto' => 'produto_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVenda()
    {
        return $this->hasOne(Venda::className(), ['idVenda' => 'venda_id']);
    }
}
