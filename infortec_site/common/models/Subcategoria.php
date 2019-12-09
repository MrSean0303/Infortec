<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "subcategoria".
 *
 * @property int $idsubCategoria
 * @property string $nome
 * @property int $categoria_id
 *
 * @property Produto[] $produtos
 * @property Categoria $categoria
 */
class Subcategoria extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subcategoria';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'categoria_id'], 'required'],
            [['categoria_id'], 'integer'],
            [['nome'], 'string', 'max' => 255],
            [['nome'], 'unique'],
            [['categoria_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::className(), 'targetAttribute' => ['categoria_id' => 'idCategoria']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idsubCategoria' => 'Idsub Categoria',
            'nome' => 'Nome',
            'categoria_id' => 'Categoria ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdutos()
    {
        return $this->hasMany(Produto::className(), ['subCategoria_id' => 'idsubCategoria']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Categoria::className(), ['idCategoria' => 'categoria_id']);
    }
}
