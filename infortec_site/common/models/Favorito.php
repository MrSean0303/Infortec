<?php

namespace common\models;

use common\mosquitto\phpMQTT;
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

    public function afterDelete()
    {
        parent::afterDelete();
        $id= $this->idFavorito;
        $myObj=new \stdClass();
        $myObj->id=$id;
        $myJSON = json_encode($myObj);
        $this->FazPublish("DELETE",$myJSON);
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        //Obter dados do registo em causa
        $id=$this->idFavorito;
        $produto_id=$this->produto_id;
        $utilizador_id=$this->utilizador_id;

        $myObj=new \stdClass();
        $myObj->id=$id;
        $myObj->produto_id=$produto_id;
        $myObj->utilizador_id=$utilizador_id;

        $myJSON = json_encode($myObj);
        if($insert)
            $this->FazPublish("INSERT",$myJSON);
        else
            $this->FazPublish("UPDATE",$myJSON);
    }

    public function FazPublish($canal,$msg)
    {
        $server = "127.0.0.1";
        $port = 1883;
        $username = ""; // set your username
        $password = ""; // set your password
        $client_id = "phpMQTT-publisher"; // unique!
        $mqtt = new phpMQTT($server, $port, $client_id);
        if ($mqtt->connect(true, NULL, $username, $password))
        {
            $mqtt->publish($canal, $msg, 0);
            $mqtt->close();
        }
        else { file_put_contents("debug.output","Time out!"); }
    }
}
