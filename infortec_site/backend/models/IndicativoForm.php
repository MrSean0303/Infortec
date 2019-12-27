<?php

namespace backend\models;

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
            [['iconImage'], 'file', 'extensions' => 'jpg, png'],
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

    public function uploadImage(){
        $this->iconImage = UploadedFile::getInstance($this, 'iconImage');

        $this->icon = $this->iconImage->baseName.".".$this->iconImage->extension;

        if ($this->iconImage) {
            $this->iconImage->saveAs(Yii::getAlias('@frontend/web/imagens/icons/') . $this->iconImage->baseName . '.' . $this->iconImage->extension);
        }

    }

    public function deleteImage(){

        if (file_exists(Yii::getAlias('@frontend/web/imagens/icons/') . $this->icon)){
            unlink(Yii::getAlias('@frontend/web/imagens/icons/') . $this->icon);
        }

    }

}

