<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "indicativo".
 *
 * @property int $idIndicativo
 * @property resource $icon
 * @property string $pais
 * @property string $indicativo
 *
 * @property Contacto[] $contactos
 */
class Indicativo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
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
            [['icon'], 'string'],
            [['pais', 'indicativo'], 'required'],
            [['pais', 'indicativo'], 'string', 'max' => 255],
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
}
