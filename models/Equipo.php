<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "equipo".
 *
 * @property int $idEquipo
 * @property int $numEquipo
 * @property string $nombreEquipo
 * @property int $idCategoria
 *
 * @property Categoria $idCategoria0
 * @property EquipoCorredor[] $equipocorredors
 */
class Equipo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'equipo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['numEquipo', 'nombreEquipo', 'idCategoria'], 'required'],
            [['numEquipo', 'idCategoria'], 'integer'],
            [['nombreEquipo'], 'string', 'max' => 120],
            [['idCategoria'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::className(), 'targetAttribute' => ['idCategoria' => 'idCategoria']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idEquipo' => 'Id Equipo',
            'numEquipo' => 'Num Equipo',
            'nombreEquipo' => 'Nombre Equipo',
            'idCategoria' => 'Id Categoria',
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
     * Gets query for [[Equipocorredors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEquipocorredors()
    {
        return $this->hasMany(EquipoCorredor::className(), ['idEquipo' => 'idEquipo']);
    }

    public function cantidadParticipantes(){
        $cantidadParticipantesEquipo=$corredores=Yii::$app->getDb()->createCommand("SELECT COUNT(*) as cantidad_participantes FROM equipocorredor WHERE idEquipo=$this->idEquipo")->queryOne();
        return $cantidadParticipantesEquipo["cantidad_participantes"];

    }

    public function getNombreParticipantesEquipo(){
        $personasEquipo=Equipocorredor::findAll(['idEquipo'=>$this->idEquipo]);
        $nombre="";
        foreach ($personasEquipo as $persona){
              $nombre.= $persona->corredor->persona->getNombreCompleto()."<span style='font-size: 13px' class='tiempo'>(".$persona->corredor->myTiempo().')</span> <br> ';
        }
        //Remove the last character using rtrim
        $nombre = rtrim($nombre, "- ");
        return $nombre;
    }
}
