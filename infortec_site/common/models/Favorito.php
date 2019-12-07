<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "favorito".
 *
 * @property int $idFavorito
 * @property int $produto_id
 * @property int $utilizador_id
 *
 * @property Produto $produto
 * @property Utilizador $utilizador
 */
class Favorito extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'favorito';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['produto_id', 'utilizador_id'], 'required'],
            [['produto_id', 'utilizador_id'], 'integer'],
            [['produto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Produto::className(), 'targetAttribute' => ['produto_id' => 'idProduto']],
            [['utilizador_id'], 'exist', 'skipOnError' => true, 'targetClass' => Utilizador::className(), 'targetAttribute' => ['utilizador_id' => 'idUtilizador']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idFavorito' => 'Id Favorito',
            'produto_id' => 'Produto ID',
            'utilizador_id' => 'Utilizador ID',
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
    public function getUtilizador()
    {
        return $this->hasOne(Utilizador::className(), ['idUtilizador' => 'utilizador_id']);
    }
}
