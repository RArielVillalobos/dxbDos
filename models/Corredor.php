<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "corredor".
 *
 * @property int $idCorredor
 * @property int $numCorredor
 * @property int $idCategoria
 * @property int $idPersona
 * @property int $tiempo
 *
 * @property Categoria $idCategoria0
 * @property Persona $idPersona0
 * @property EquipoCorredor[] $equipocorredors
 */
class Corredor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'corredor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['numCorredor', 'idCategoria', 'idPersona', 'tiempo'], 'required'],
            [['numCorredor', 'idCategoria', 'idPersona', 'tiempo'], 'integer'],
            [['idCategoria'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::className(), 'targetAttribute' => ['idCategoria' => 'idCategoria']],
            [['idPersona'], 'exist', 'skipOnError' => true, 'targetClass' => Persona::className(), 'targetAttribute' => ['idPersona' => 'idPersona']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idCorredor' => 'Id Corredor',
            'numCorredor' => 'Num Corredor',
            'idCategoria' => 'Id Categoria',
            'idPersona' => 'Id Persona',
            'tiempo' => 'Tiempo',
        ];
    }

    /**
     * Gets query for [[IdCategoria0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdCategoria0()
    {
        return $this->hasOne(Categoria::className(), ['idCategoria' => 'idCategoria']);
    }

    /**
     * Gets query for [[IdPersona0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdPersona0()
    {
        return $this->hasOne(Persona::className(), ['idPersona' => 'idPersona']);
    }

    /**
     * Gets query for [[Equipocorredors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEquipocorredors()
    {
        return $this->hasMany(EquipoCorredor::className(), ['idCorredor' => 'idCorredor']);
    }
}
