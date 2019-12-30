<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "produto".
 *
 * @property int $idProduto
 * @property string $nome
 * @property string $fotoProduto
 * @property string $descricao
 * @property string $descricaoGeral
 * @property string $preco
 * @property int $quantStock
 * @property string $valorDesconto
 * @property int $pontos
 * @property int $subCategoria_id
 * @property int $iva_id
 *
 * @property Favorito[] $favoritos
 * @property Linhavenda[] $linhavendas
 * @property Iva $iva
 * @property Subcategoria $subCategoria
 */
class Produto extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile
     */
    //public $imageFile;

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
            //[['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
            [['nome', 'descricao', 'descricaoGeral', 'preco', 'quantStock', 'subCategoria_id'], 'required'],
            [['descricao', 'descricaoGeral'], 'string'],
            [['preco', 'valorDesconto'], 'number'],
            [['quantStock', 'pontos', 'subCategoria_id', 'iva_id'], 'integer'],
            [['nome', 'fotoProduto'], 'string', 'max' => 255],
            [['fotoProduto'], 'unique'],
            [['iva_id'], 'exist', 'skipOnError' => true, 'targetClass' => Iva::className(), 'targetAttribute' => ['iva_id' => 'idIva']],
            [['subCategoria_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subcategoria::className(), 'targetAttribute' => ['subCategoria_id' => 'idsubCategoria']],
        ];
    }

    /*
    public function upload()
    {
        $this->imageFile->saveAs(Yii::getAlias('@frontend/web/imagens/' . $this->imageFile->baseName . '.' . $this->imageFile->extension));
        $this->fotoProduto = $this->imageFile->baseName;
        return true;
    }
    */

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
            'descricaoGeral' => 'Descricao Geral',
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
    public function getIva()
    {
        return $this->hasOne(Iva::className(), ['idIva' => 'iva_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubCategoria()
    {
        return $this->hasOne(Subcategoria::className(), ['idsubCategoria' => 'subCategoria_id']);
    }

    public function getCategoria()
    {
        return $this->hasOne(Categoria::className(), ['idCategoria' => 'categoria_id'])->via('subCategoria');
    }
}
