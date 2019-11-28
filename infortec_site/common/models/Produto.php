<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "produto".
 *
 * @property int $idProduto
 * @property string $nome
 * @property resource $fotoProduto
 * @property string $descricao
 * @property string $preco
 * @property int $quantStock
 * @property string $valorDesconto
 * @property int $pontos
 * @property int $subCategoria_id
 * @property int $iva_id
 *
 * @property Favorito[] $favoritos
 * @property Linhavenda[] $linhavendas
 * @property Categoria $subCategoria
 * @property Iva $iva
 */
class Produto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'produto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'descricao', 'preco', 'quantStock', 'subCategoria_id'], 'required'],
            [['fotoProduto', 'descricao'], 'string'],
            [['preco', 'valorDesconto'], 'number'],
            [['quantStock', 'pontos', 'subCategoria_id', 'iva_id'], 'integer'],
            [['nome'], 'string', 'max' => 255],
            [['subCategoria_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::className(), 'targetAttribute' => ['subCategoria_id' => 'idCategoria']],
            [['iva_id'], 'exist', 'skipOnError' => true, 'targetClass' => Iva::className(), 'targetAttribute' => ['iva_id' => 'idIva']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idProduto' => 'Id Produto',
            'nome' => 'Nome',
            'fotoProduto' => 'Foto Produto',
            'descricao' => 'Descricao',
            'preco' => 'Preco',
            'quantStock' => 'Quant Stock',
            'valorDesconto' => 'Valor Desconto',
            'pontos' => 'Pontos',
            'subCategoria_id' => 'Sub Categoria ID',
            'iva_id' => 'Iva ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFavoritos()
    {
        return $this->hasMany(Favorito::className(), ['produto_id' => 'idProduto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLinhavendas()
    {
        return $this->hasMany(Linhavenda::className(), ['produto_id' => 'idProduto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubCategoria()
    {
        return $this->hasOne(Categoria::className(), ['idCategoria' => 'subCategoria_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIva()
    {
        return $this->hasOne(Iva::className(), ['idIva' => 'iva_id']);
    }


    public function searchProductByName()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }

        return false;
    }

}
