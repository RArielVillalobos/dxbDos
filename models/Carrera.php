<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "carrera".
 *
 * @property int $idCarrera
 * @property string $fecha
 * @property string $nombre
 **@property Evento $idEvento
 * @property Categoria[] $categorias
 */
class Carrera extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'carrera';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fecha', 'nombre','idEvento'], 'required'],
            [['fecha'], 'safe'],
            [['nombre'], 'string', 'max' => 120],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idCarrera' => 'Id Carrera',
            'fecha' => 'Fecha',
            'nombre' => 'Nombre',
            ''
        ];
    }

    /**
     * Gets query for [[Categorias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategorias()
    {
        return $this->hasMany(Categoria::className(), ['idCarrera' => 'idCarrera']);
    }

    public function getEvento()
    {
        return $this->hasOne(Evento::className(), ['idEvento' => 'idEvento']);
    }
    public function GetEvent(){
        return $this->evento->nombre;
    }
}
