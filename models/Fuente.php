<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fuente".
 *
 * @property int $idFuente
 * @property string $nombre
 *
 * @property Tiempo $tiempo
 */
class Fuente extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fuente';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idFuente' => 'Id Fuente',
            'nombre' => 'Nombre',
        ];
    }

    /**
     * Gets query for [[Tiempo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTiempo()
    {
        return $this->hasOne(Tiempo::className(), ['idFuente' => 'idFuente']);
    }
}
