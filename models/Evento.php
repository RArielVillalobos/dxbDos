<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "evento".
 *
 * @property int $idEvento
 * @property string $nombre
 * @property string $lugar
 * @property string $fecha
 * @property string $imagen
 *
 * @property Carrera[] $carreras
 * @property UsuarioEvento[] $usuarioEventos
 */
class Evento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'evento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'lugar', 'fecha', 'imagen'], 'required'],
            [['fecha'], 'safe'],
            [['nombre', 'lugar'], 'string', 'max' => 300],
            [['imagen'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idEvento' => 'Id Evento',
            'nombre' => 'Nombre',
            'lugar' => 'Lugar',
            'fecha' => 'Fecha',
            'imagen' => 'Imagen',
        ];
    }

    /**
     * Gets query for [[Carreras]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarreras()
    {
        return $this->hasMany(Carrera::className(), ['idEvento' => 'idEvento']);
    }

    /**
     * Gets query for [[UsuarioEventos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioEventos()
    {
        return $this->hasMany(UsuarioEvento::className(), ['idEvento' => 'idEvento']);
    }
}
