<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "puntoCheck".
 *
 * @property int $idPunto
 * @property int $idCarrera
 * @property string $nombre
 * @property int $km
 * @property int $idTipoPunto
 *
 * @property Carrera $idCarrera0
 * @property TipoPunto $idTipoPunto0
 * @property Tiempo[] $tiempos
 */
class PuntoCheck extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'puntoCheck';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idCarrera', 'nombre', 'km', 'idTipoPunto'], 'required'],
            [['idCarrera', 'km', 'idTipoPunto'], 'integer'],
            [['nombre'], 'string', 'max' => 200],
            [['idCarrera'], 'exist', 'skipOnError' => true, 'targetClass' => Carrera::className(), 'targetAttribute' => ['idCarrera' => 'idCarrera']],
            [['idTipoPunto'], 'exist', 'skipOnError' => true, 'targetClass' => TipoPunto::className(), 'targetAttribute' => ['idTipoPunto' => 'idTipo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idPunto' => 'Id Punto',
            'idCarrera' => 'Id Carrera',
            'nombre' => 'Nombre',
            'km' => 'Km',
            'idTipoPunto' => 'Id Tipo Punto',
        ];
    }

    /**
     * Gets query for [[IdCarrera0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdCarrera0()
    {
        return $this->hasOne(Carrera::className(), ['idCarrera' => 'idCarrera']);
    }

    /**
     * Gets query for [[IdTipoPunto0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdTipoPunto0()
    {
        return $this->hasOne(TipoPunto::className(), ['idTipo' => 'idTipoPunto']);
    }

    /**
     * Gets query for [[Tiempos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTiempos()
    {
        return $this->hasMany(Tiempo::className(), ['idPunto' => 'idPunto']);
    }
}
