<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuarioEvento".
 *
 * @property int $idUsuarioEvento
 * @property int $idUsuario
 * @property int $idEvento
 * @property int $idRol
 *
 * @property Usuario $idUsuario0
 * @property Evento $idEvento0
 * @property Rol $idRol0
 */
class UsuarioEvento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuarioEvento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idUsuario', 'idEvento', 'idRol'], 'required'],
            [['idUsuario', 'idEvento', 'idRol'], 'integer'],
            [['idUsuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['idUsuario' => 'idUsuario']],
            [['idEvento'], 'exist', 'skipOnError' => true, 'targetClass' => Evento::className(), 'targetAttribute' => ['idEvento' => 'idEvento']],
            [['idRol'], 'exist', 'skipOnError' => true, 'targetClass' => Rol::className(), 'targetAttribute' => ['idRol' => 'idRol']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idUsuarioEvento' => 'Id Usuario Evento',
            'idUsuario' => 'Id Usuario',
            'idEvento' => 'Id Evento',
            'idRol' => 'Id Rol',
        ];
    }

    /**
     * Gets query for [[IdUsuario0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuario0()
    {
        return $this->hasOne(Usuario::className(), ['idUsuario' => 'idUsuario']);
    }

    /**
     * Gets query for [[IdEvento0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdEvento0()
    {
        return $this->hasOne(Evento::className(), ['idEvento' => 'idEvento']);
    }

    /**
     * Gets query for [[IdRol0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdRol0()
    {
        return $this->hasOne(Rol::className(), ['idRol' => 'idRol']);
    }
}
