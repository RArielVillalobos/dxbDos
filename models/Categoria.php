<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categoria".
 *
 * @property int $idCategoria
 * @property int $idCarrera
 * @property int $kilometros
 * @property string $nombreCategoria
 * @property int $equipo
 *
 * @property Carrera $idCarrera0
 * @property Corredor[] $corredors
 * @property Equipo[] $equipos
 */
class Categoria extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categoria';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idCarrera', 'kilometros', 'nombreCategoria', 'equipo'], 'required'],
            [['idCarrera', 'kilometros', 'equipo'], 'integer'],
            [['nombreCategoria'], 'string', 'max' => 120],
            [['idCarrera'], 'exist', 'skipOnError' => true, 'targetClass' => Carrera::className(), 'targetAttribute' => ['idCarrera' => 'idCarrera']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idCategoria' => 'Id Categoria',
            'idCarrera' => 'Id Carrera',
            'kilometros' => 'Kilometros',
            'nombreCategoria' => 'Nombre Categoria',
            'equipo' => 'Equipo',
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
     * Gets query for [[Corredors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCorredors()
    {
        return $this->hasMany(Corredor::className(), ['idCategoria' => 'idCategoria']);
    }

    /**
     * Gets query for [[Equipos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEquipos()
    {
        return $this->hasMany(Equipo::className(), ['idCategoria' => 'idCategoria']);
    }
}
