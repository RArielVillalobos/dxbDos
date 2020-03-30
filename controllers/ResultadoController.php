<?php

namespace app\controllers;

use app\models\Carrera;
use app\models\Categoria;
use app\models\Equipo;
use app\models\Evento;
use yii\helpers\Json;

class ResultadoController extends \yii\web\Controller
{

    public function init(){
        $this->layout=false;

    }
    public function actionIndex()
    {
        $idEvento=(isset($_GET["evento"]))? $_GET["evento"] : null;
        if($idEvento!=null){
            $evento=Evento::find()->where(["idEvento"=>$idEvento])->one();
            $carreras=Carrera::find()->where(["idEvento"=>$idEvento])->all();
        }


        return $this->render('index',['carreras'=>$carreras,'evento'=>$evento]);
    }

    /*AJAX-> CARGA EL COMBO DE CATEGORIAS*/
    public function actionCategorias(){
        $this->enableCsrfValidation = false;
        $carrera=$_GET["carrera"];

        $categorias=Categoria::find()->where(['idCarrera'=>$carrera])->all();


        return Json::htmlEncode($categorias);

    }
    /*AJAX->CARGA RESULTADOS GENERALES SEGUN EL IDCARRERA*/
    public function actionGeneral(){
       $carrera=$_GET["carrera"];
       $sql="SELECT c.numCorredor,p.nombre,tiempo,cat.nombreCategoria FROM corredor AS c 
            INNER JOIN persona AS p ON c.idPersona=p.idPersona
            INNER JOIN categoria AS cat ON c.idCategoria=cat.idCategoria
            INNER JOIN carrera AS car ON cat.idCarrera=car.idCarrera
             WHERE tiempo>0 AND  cat.idCarrera=$carrera AND cat.equipo=0 ORDER BY c.tiempo asc";

       $resultado=\Yii::$app->getDb()->createCommand($sql)->queryAll();
       return Json::htmlEncode($resultado);
    }


    public function actionResultadocategoria(){
        $categoriaSeleccionada=$_GET["categoria"];
        $categoria=Categoria::find()->where(['idCategoria'=>$categoriaSeleccionada])->one();
        /* SI ES UN EQUIPO MUESTRA UNA GRILLA DISTINTA(NOMBRES APILADOS)**/
        if($categoria->equipo==1){
            $resultado=[];
            $sql="SELECT COUNT(ec.idEquipo) llegaron_a_meta,SUM(c.tiempo)AS sumaTotal,
            ec.idEquipo,e.nombreEquipo,cat.nombreCategoria,e.idCategoria
            from persona AS p 
            INNER JOIN corredor AS c ON (p.idPersona=c.idPersona)
            INNER JOIN equipocorredor AS ec ON (ec.idCorredor=c.idCorredor)
            INNER JOIN equipo AS e ON (e.idEquipo=ec.idEquipo)
             INNER JOIN categoria AS cat ON (cat.idCategoria=e.idCategoria) WHERE c.tiempo>0 AND  e.idCategoria=$categoriaSeleccionada GROUP BY ec.idEquipo ORDER BY sumaTotal ASC";
            $rta=\Yii::$app->getDb()->createCommand($sql)->queryAll();
            foreach ($rta as $corredor){
                $equipo=Equipo::findOne(["idEquipo"=>$corredor["idEquipo"]]);
                if($equipo->cantidadParticipantes()==$corredor["llegaron_a_meta"]){
                   $resultado[]=["nombre"=>$equipo->getNombreParticipantesEquipo(),
                                "nombreCategoria"=>$corredor["nombreCategoria"],
                                "tiempo"=>$corredor["sumaTotal"]];
                }
            }

        }else{
            $sql="SELECT c.numCorredor,p.nombre,tiempo,cat.nombreCategoria,cat.equipo FROM corredor AS c 
              INNER JOIN persona AS p ON c.idPersona=p.idPersona
              INNER JOIN categoria AS cat ON c.idCategoria=cat.idCategoria
              INNER JOIN carrera AS car ON cat.idCarrera=car.idCarrera
              WHERE tiempo>0 AND  c.idCategoria=$categoriaSeleccionada ORDER BY c.tiempo asc";
            $resultado=\Yii::$app->getDb()->createCommand($sql)->queryAll();
        }
        return Json::htmlEncode($resultado);
    }

}
