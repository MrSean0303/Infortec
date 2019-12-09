<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "venda".
 *
 * @property int $idVenda
 * @property string $totalVenda
 * @property string $data
 * @property int $utilizador_id
 *
 * @property Linhavenda[] $linhavendas
 * @property Utilizador $utilizador
 */
class Venda extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'venda';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['totalVenda', 'data', 'utilizador_id'], 'required'],
            [['totalVenda'], 'number'],
            [['data'], 'safe'],
            [['utilizador_id'], 'integer'],
            [['utilizador_id'], 'exist', 'skipOnError' => true, 'targetClass' => Utilizador::className(), 'targetAttribute' => ['utilizador_id' => 'idUtilizador']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idVenda' => 'Id Venda',
            'totalVenda' => 'Total Venda',
            'data' => 'Data',
            'utilizador_id' => 'Utilizador ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLinhavendas()
    {
        return $this->hasMany(Linhavenda::className(), ['venda_id' => 'idVenda']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtilizador()
    {
        return $this->hasOne(Utilizador::className(), ['idUtilizador' => 'utilizador_id']);
    }
}
