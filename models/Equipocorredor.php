<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "equipocorredor".
 *
 * @property int $idEquipoCorredor
 * @property int $idEquipo
 * @property int $idCorredor
 *
 * @property Corredor $idCorredor0
 * @property Equipo $idEquipo0
 */
class Equipocorredor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'equipocorredor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idEquipo', 'idCorredor'], 'required'],
            [['idEquipo', 'idCorredor'], 'integer'],
            [['idCorredor'], 'exist', 'skipOnError' => true, 'targetClass' => Corredor::className(), 'targetAttribute' => ['idCorredor' => 'idCorredor']],
            [['idEquipo'], 'exist', 'skipOnError' => true, 'targetClass' => Equipo::className(), 'targetAttribute' => ['idEquipo' => 'idEquipo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idEquipoCorredor' => 'Id Equipo Corredor',
            'idEquipo' => 'Id Equipo',
            'idCorredor' => 'Id Corredor',
        ];
    }

    /**
     * Gets query for [[IdCorredor0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCorredor()
    {
        return $this->hasOne(Corredor::className(), ['idCorredor' => 'idCorredor']);
    }

    /**
     * Gets query for [[IdEquipo0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdEquipo0()
    {
        return $this->hasOne(Equipo::className(), ['idEquipo' => 'idEquipo']);
    }
}
