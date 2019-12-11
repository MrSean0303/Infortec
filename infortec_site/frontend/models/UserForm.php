<?php

namespace frontend\models;

use common\models\User;
use common\models\Utilizador;
use Yii;

/**
 * This is the model class for table "user".
 *
 * @property Utilizador[] $utilizadors
 */
class UserForm extends \yii\db\ActiveRecord
{
    public $username;
    public $email;
    public $nome;
    public $morada;
    public $pontos;
    public $nif;
    public $oldpassword;
    public $password;
    public $otherpassword;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username','email', 'nome', 'morada'], 'required'],
            [['nif', 'pontos'], 'integer'],
            [['username', 'email', 'nome', 'morada'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['email'], 'unique'],

            ['password', 'string', 'min' => 6],

            ['otherpassword', 'compare', 'compareAttribute' => 'password', 'message' => 'A palavras passe não coincidem'],
            ['otherpassword', 'string', 'min' => 6],

            ['oldpassword', 'string', 'min' => 6],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome Proprio',
            'username' => 'Username',
            'email' => 'Email',
            'morada' => 'Morada',
            'nif' => 'Número de identificação fiscal',
            'pontos' => 'Pontos',
        ];
    }

    public function editUser()
    {
        $user = new User();
        $utilizador = new Utilizador();

        $utilizador->nome = $this->nome;
        $user->username = $this->username;
        $user->email = $this->email;
        $utilizador->morada = $this->morada;
        $utilizador->nif = $this->nif;

        $utilizador->user_id = $user->id;
        $utilizador->save();
        return true;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtilizadors()
    {
        return $this->hasMany(Utilizador::className(), ['user_id' => 'id']);
    }
}
