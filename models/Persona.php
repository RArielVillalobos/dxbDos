<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "persona".
 *
 * @property int $idPersona
 * @property int $dni
 * @property string $nombre
 * @property string $apellido
 * @property string $procedencia
 * @property string $fechaNac
 * @property int $idGenero
 * @property int $annoNac
 *
 * @property Corredor[] $corredors
 */
class Persona extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'persona';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dni', 'nombre', 'procedencia', 'annoNac'], 'required'],
            [['dni', 'idGenero', 'annoNac'], 'integer'],
            [['fechaNac'], 'safe'],
            [['nombre', 'apellido'], 'string', 'max' => 120],
            [['procedencia'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idPersona' => 'Id Persona',
            'dni' => 'Dni',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'procedencia' => 'Procedencia',
            'fechaNac' => 'Fecha Nac',
            'idGenero' => 'Id Genero',
            'annoNac' => 'Anno Nac',
        ];
    }

    /**
     * Gets query for [[Corredors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCorredor()
    {
        return $this->hasMany(Corredor::className(), ['idPersona' => 'idPersona']);
    }

    public function myPosition(){

    }

    public function getNombreCompleto(){

        $nombreCompleto=$this->apellido." ".$this->nombre;
        return $nombreCompleto;

    }
}
