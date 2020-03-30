<?php

namespace app\modules\api\models;

use Yii;

/**
 * This is the model class for table "tiempo".
 *
 * @property int $idTiempo
 * @property int $idPunto
 * @property string $tiempo
 * @property int $idUsuario
 * @property int $numCorredor
 * @property int|null $idCorredor
 * @property int|null $idFuente
 *
 * @property PuntoCheck $idPunto0
 * @property Fuente $idFuente0
 * @property Usuario $idUsuario0
 */
class Tiempo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tiempo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idPunto', 'idUsuario', 'numCorredor'], 'required'],
            [['idPunto', 'idUsuario', 'numCorredor', 'idCorredor', 'idFuente'], 'integer'],
            [['tiempo'], 'safe'],
            [['idFuente'], 'unique'],
            [['idPunto'], 'exist', 'skipOnError' => true, 'targetClass' => PuntoCheck::className(), 'targetAttribute' => ['idPunto' => 'idPunto']],
            [['idFuente'], 'exist', 'skipOnError' => true, 'targetClass' => Fuente::className(), 'targetAttribute' => ['idFuente' => 'idFuente']],
            [['idUsuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['idUsuario' => 'idUsuario']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idTiempo' => 'Id Tiempo',
            'idPunto' => 'Id Punto',
            'tiempo' => 'Tiempo',
            'idUsuario' => 'Id Usuario',
            'numCorredor' => 'Num Corredor',
            'idCorredor' => 'Id Corredor',
            'idFuente' => 'Id Fuente',
        ];
    }

    /**
     * Gets query for [[IdPunto0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdPunto0()
    {
        return $this->hasOne(PuntoCheck::className(), ['idPunto' => 'idPunto']);
    }

    /**
     * Gets query for [[IdFuente0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdFuente0()
    {
        return $this->hasOne(Fuente::className(), ['idFuente' => 'idFuente']);
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
}
