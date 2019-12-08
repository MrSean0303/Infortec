<?php

namespace frontend\models;

use common\models\Contacto;
use common\models\Indicativo;
use common\models\Utilizador;
use Yii;
use yii\base\Model;

/**
 * This is the model class for table "contacto".
 *
 * @property Indicativo $indicativo
 * @property Utilizador $utilizador
 */
class ContactoForm extends Model
{
    public $idContacto;
    public $numero;
    public $utilizador_id;
    public $indicativo_id;

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
            [['numero', 'utilizador_id', 'indicativo_id', ], 'integer'],
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

    public function create(){

        if (!$this->validate()) {
            return null;
        }

        $contacto = new Contacto();

        $contacto->numero = $this->numero;
        $contacto->utilizador_id = Yii::$app->user->id;
        $contacto->indicativo_id = $this->indicativo_id;

        $contacto->save();

        return true;

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
