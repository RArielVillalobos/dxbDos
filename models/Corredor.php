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
    public function getCategoria()
    {
        return $this->hasOne(Categoria::className(), ['idCategoria' => 'idCategoria']);
    }

    /**
     * Gets query for [[IdPersona0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPersona()
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

    public static function getCorredores($idCategoria){
        $corredores = Yii::$app->getDb()->createCommand("SELECT idCorredor,numCorredor,p.nombre,p.apellido,p.dni,c.kilometros,c.nombreCategoria ,p.idPersona,s.tiempo,IF (@score=s.tiempo, @rank:=@rank, @rank:=@rank+1) rank, @score:=s.tiempo score FROM corredor s INNER JOIN categoria AS c ON (s.idCategoria=c.idCategoria) INNER JOIN persona AS p ON (s.idPersona=p.idPersona), (SELECT @score:=0, @rank:=0) r WHERE s.idCategoria=$idCategoria AND c.equipo=0 AND s.tiempo>0 ORDER BY rank ASC")->queryAll();
        return $corredores;
    }

    public static function getCorredoresGeneral($kilometros,$equipo=false){
        $corredores= Yii::$app->getDb()->createCommand("SELECT idCorredor,numCorredor,p.nombre,p.apellido,p.dni,c.kilometros,c.nombreCategoria ,p.idPersona,s.tiempo,IF (@score=s.tiempo, @rank:=@rank, @rank:=@rank+1) rank, @score:=s.tiempo score FROM corredor s INNER JOIN categoria AS c ON (s.idCategoria=c.idCategoria) INNER JOIN persona AS p ON (s.idPersona=p.idPersona), (SELECT @score:=0, @rank:=0) r WHERE c.kilometros=$kilometros AND c.equipo=$equipo AND s.tiempo>0 ORDER BY rank ASC")->queryAll();
        return $corredores;
    }
    public static function getCorredorByNombreNumero($nombre){
        $corredores=Yii::$app->getDb()->createCommand("SELECT idCorredor,numCorredor,p.nombre,p.apellido,p.dni,c.kilometros,c.nombreCategoria ,p.idPersona,s.tiempo,IF (@score=s.tiempo, @rank:=@rank, @rank:=@rank+1) rank, @score:=s.tiempo score 
            FROM corredor s INNER JOIN categoria AS c ON (s.idCategoria=c.idCategoria)
            INNER JOIN persona AS p ON (s.idPersona=p.idPersona), 
            (SELECT @score:=0, @rank:=0) r WHERE p.nombre LIKE '%$nombre%' AND c.equipo=0 AND s.tiempo>0 ORDER BY rank ASC")->queryAll();

        return $corredores;
    }

    public function getCate() {

        return $this->categoria->nombreCategoria;

    }

    //viejo
    /*public static function getCorredoresEquiposByCategoria($idCategoria){
        $users = $corredores = Yii::$app->getDb()->createCommand("SELECT idCorredor,numCorredor,p.nombre,p.apellido,p.dni,c.kilometros,c.nombreCategoria ,p.idPersona,s.tiempo,IF (@score=s.tiempo, @rank:=@rank, @rank:=@rank+1) rank, @score:=s.tiempo score FROM corredor s INNER JOIN categoria AS c ON (s.idCategoria=c.idCategoria) INNER JOIN persona AS p ON (s.idPersona=p.idPersona), (SELECT @score:=0, @rank:=0) r WHERE s.idCategoria=$idCategoria AND c.equipo=1 ORDER BY rank ASC")->queryAll();
        return $users;
    }*/

    //nuevo
    public static function getCorredoresEquiposByCategoria($idCategoria){
        $corredores=Yii::$app->getDb()->createCommand("SELECT COUNT(ec.idEquipo) llegaron_a_meta,SUM(c.tiempo)AS sumaTotal,
        ec.idEquipo,e.nombreEquipo,cat.nombreCategoria,e.idCategoria
         from persona AS p 
        INNER JOIN corredor AS c ON (p.idPersona=c.idPersona)
        INNER JOIN equipocorredor AS ec ON (ec.idCorredor=c.idCorredor)
        INNER JOIN equipo AS e ON (e.idEquipo=ec.idEquipo)
        INNER JOIN categoria AS cat ON (cat.idCategoria=e.idCategoria) WHERE c.tiempo>0 AND  e.idCategoria=$idCategoria GROUP BY ec.idEquipo ORDER BY sumaTotal ASC")->queryAll();
        return $corredores;
    }

    public function myTiempo(){
        $tiempo=$this->tiempo;

        return date("H:i:s", $tiempo / 1000);
    }


    //comun-actual
    //SELECT *, IF (@score=s.tiempo, @rank:=@rank, @rank:=@rank+1) rank, @score:=s.tiempo score FROM corredor s, (SELECT @score:=0, @rank:=0) r WHERE idCategoria=$idCategoria ORDER BY tiempo DESC


    //SELECT idCorredor,numCorredor,idCategoria ,idPersona,s.tiempo,IF (@score=s.tiempo, @rank:=@rank, @rank:=@rank+1) rank, @score:=s.tiempo score FROM corredor s, (SELECT @score:=0, @rank:=0) r WHERE idCategoria=1 ORDER BY tiempo DESC
    //SELECT idCorredor,numCorredor,c.nombreCategoria ,idPersona,s.tiempo,IF (@score=s.tiempo, @rank:=@rank, @rank:=@rank+1) rank, @score:=s.tiempo score FROM corredor s INNER JOIN categoria AS c ON (s.idCategoria=c.idCategoria), (SELECT @score:=0, @rank:=0) r  ORDER BY tiempo DESC
    //SELECT idCorredor,numCorredor,p.nombre,p.apellido,p.dni,c.nombreCategoria ,p.idPersona,s.tiempo,IF (@score=s.tiempo, @rank:=@rank, @rank:=@rank+1) rank, @score:=s.tiempo score FROM corredor s INNER JOIN categoria AS c ON (s.idCategoria=c.idCategoria) INNER JOIN persona AS p ON (s.idPersona=p.idPersona), (SELECT @score:=0, @rank:=0) r  ORDER BY rank DESC

    //para general
    //SELECT idCorredor,numCorredor,p.nombre,p.apellido,p.dni,c.kilometros,c.nombreCategoria ,p.idPersona,s.tiempo,IF (@score=s.tiempo, @rank:=@rank, @rank:=@rank+1) rank, @score:=s.tiempo score FROM corredor s INNER JOIN categoria AS c ON (s.idCategoria=c.idCategoria) INNER JOIN persona AS p ON (s.idPersona=p.idPersona), (SELECT @score:=0, @rank:=0) r WHERE c.kilometros=5 AND c.equipo=false  ORDER BY rank DESC
}
