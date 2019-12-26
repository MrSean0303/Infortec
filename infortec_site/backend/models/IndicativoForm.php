<?php

namespace backend\models;

use common\models\Indicativo;
use Yii;
use yii\web\UploadedFile;


/**
 * This is the model class for table "indicativo".
 *
 * @property int $idIndicativo
 * @property string $icon
 * @property string $pais
 * @property string $indicativo
 *
 * @property Contacto[] $contactos
 */

class IndicativoForm extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $iconImage;
    public static function tableName()
    {
        return 'indicativo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['icon', 'pais', 'indicativo'], 'required'],
            [['icon', 'pais', 'indicativo'], 'string', 'max' => 255],
            [['icon'], 'unique'],
            [['iconImage'], 'file'],
            [['pais'], 'unique'],
            [['indicativo'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idIndicativo' => 'Id Indicativo',
            'icon' => 'Icon',
            'pais' => 'Pais',
            'indicativo' => 'Indicativo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContactos()
    {
        return $this->hasMany(Contacto::className(), ['indicativo_id' => 'idIndicativo']);
    }

    public function createInciativo(){
        $this->iconImage = UploadedFile::getInstance($this, 'iconImage');

        $indicativo = new Indicativo();
        $indicativo->icon = $this->iconImage->baseName.".".$this->iconImage->extension;
        $indicativo->pais = $this->pais;
        $indicativo->indicativo = $this->indicativo;
        $indicativo->save();

        if ($this->iconImage) {
            $this->iconImage->saveAs(Yii::getAlias('@frontend/web/imagens/icons/') . $this->iconImage->baseName . '.' . $this->iconImage->extension);
        }

    }

}

