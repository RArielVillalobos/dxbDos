<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rol".
 *
 * @property int $idRol
 * @property string $nombre
 *
 * @property Usuario[] $usuarios
 * @property UsuarioEvento[] $usuarioEventos
 */
class Rol extends \yii\db\ActiveRecord
{
    const rol_admin=1;
    const rol_gestor=2;
    const rol_tracker=3;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rol';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idRol' => 'Id Rol',
            'nombre' => 'Nombre',
        ];
    }

    /**
     * Gets query for [[Usuarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuario::className(), ['idRol' => 'idRol']);
    }

    /**
     * Gets query for [[UsuarioEventos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioEventos()
    {
        return $this->hasMany(UsuarioEvento::className(), ['idRol' => 'idRol']);
    }
}
