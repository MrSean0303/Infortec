<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "contacto".
 *
 * @property int $idContacto
 * @property int $numero
 * @property int $utilizador_id
 * @property int $indicativo_id
 *
 * @property Indicativo $indicativo
 * @property Utilizador $utilizador
 */
class Contacto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contacto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['numero', 'utilizador_id', 'indicativo_id'], 'required'],
            [['numero', 'utilizador_id', 'indicativo_id'], 'integer'],
            [['indicativo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Indicativo::className(), 'targetAttribute' => ['indicativo_id' => 'idIndicativo']],
            [['utilizador_id'], 'exist', 'skipOnError' => true, 'targetClass' => Utilizador::className(), 'targetAttribute' => ['utilizador_id' => 'idUtilizador']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idContacto' => 'Id Contacto',
            'numero' => 'Numero',
            'utilizador_id' => 'Utilizador ID',
            'indicativo_id' => 'Indicativo ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIndicativo()
    {
        return $this->hasOne(Indicativo::className(), ['idIndicativo' => 'indicativo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtilizador()
    {
        return $this->hasOne(Utilizador::className(), ['idUtilizador' => 'utilizador_id']);
    }
}
