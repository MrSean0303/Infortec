<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "iva".
 *
 * @property int $idIva
 * @property int $valorIva
 *
 * @property Produto[] $produto
 */
class Iva extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'iva';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['valorIva'], 'required'],
            [['valorIva'], 'integer'],
            [['valorIva'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idIva' => 'Id Iva',
            'valorIva' => 'Valor Iva',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdutos()
    {
        return $this->hasMany(Produto::className(), ['iva_id' => 'idIva']);
    }
}
