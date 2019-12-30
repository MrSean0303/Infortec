<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "utilizador".
 *
 * @property int $idUtilizador
 * @property string $nome
 * @property int $nif
 * @property string $morada
 * @property int $cargo
 * @property int $numPontos
 * @property int $user_id
 *
 * @property Contacto[] $contactos
 * @property Favorito[] $favoritos
 * @property User $user
 * @property Venda[] $vendas
 */
class Utilizador extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'utilizador';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'cargo'], 'required'],
            [['nif', 'cargo', 'numPontos', 'user_id'], 'integer'],
            [['nome', 'morada'], 'string', 'max' => 255, 'min' => 1],
            [['nif'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idUtilizador' => 'Id Utilizador',
            'nome' => 'Nome',
            'nif' => 'Nif',
            'morada' => 'Morada',
            'cargo' => 'Cargo',
            'numPontos' => 'Num Pontos',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContactos()
    {
        return $this->hasMany(Contacto::className(), ['utilizador_id' => 'idUtilizador']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFavoritos()
    {
        return $this->hasMany(Favorito::className(), ['utilizador_id' => 'idUtilizador']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVendas()
    {
        return $this->hasMany(Venda::className(), ['utilizador_id' => 'idUtilizador']);
    }
}
