<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipoPunto".
 *
 * @property int $idTipo
 * @property string $nombre
 *
 * @property PuntoCheck[] $puntoChecks
 */
class TipoPunto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipoPunto';
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
            'idTipo' => 'Id Tipo',
            'nombre' => 'Nombre',
        ];
    }

    /**
     * Gets query for [[PuntoChecks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPuntoChecks()
    {
        return $this->hasMany(PuntoCheck::className(), ['idTipoPunto' => 'idTipo']);
    }
}
