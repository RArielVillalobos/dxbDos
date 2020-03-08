<?php

namespace app\controllers;

use app\models\Categoria;
use app\models\Corredor;
use SebastianBergmann\CodeCoverage\Report\Html\Renderer;
use yii\helpers\Json;
use yii\web\JsonParser;

class MujerescorrenController extends \yii\web\Controller
{
    const EQUIPOS=1;
    const CINCOK=2;
    const DIEZK=3;

    //public $layout="";

    public function init()

    {

        $this->layout = false;

    }
    public function actionIndex(){
        //por defecto la de 5 k individual
        //carrera
        if(isset($_GET["carrera"])){
            $carreraSeleccionadaString=$_GET["carrera"];
            $carreraSeleccionadaEntero=self::getKilometroByFiltroCarrera($carreraSeleccionadaString);

        }else{
            $carreraSeleccionadaString="5kindividual";
            $carreraSeleccionadaEntero=self::getKilometroByFiltroCarrera($carreraSeleccionadaString);
        }

        $categoriaSeleccionada=(isset($_GET["categoria"]) ? $_GET["categoria"] : "general");

        if($categoriaSeleccionada=="general"){
            $corredores=Corredor::getCorredoresGeneral($carreraSeleccionadaEntero, 0);
        }else{

            if($carreraSeleccionadaString=="equipo" /*&& $_GET["nombre_numero"]==null*/){
                $corredores=Corredor::getCorredoresEquiposByCategoria($categoriaSeleccionada);



            }
            else{

                $corredores=Corredor::getCorredores($categoriaSeleccionada);
            }

        }
        //buscador de personas/numero
        if(isset($_GET["nombre_numero"]) && $_GET["nombre_numero"]!=null){
           $corredores=Corredor::getCorredorByNombreNumero($_GET["nombre_numero"]);
        }

       //
        return $this->render('index',['corredores'=>$corredores,'categoriaSeleccionada'=>$categoriaSeleccionada,'carreraSeleccionada'=>$carreraSeleccionadaString]);
    }
    public function actionNew(){
        //por defecto 5k categoria 1
        if(!isset($_GET["carrera"])){
            $carreraSeleccionada="5kindividual";
            $categoriaSeleccionada=1;
        }else{
            $carreraSeleccionada=$_GET["carrera"];
            $categoriaSeleccionada=$_GET["categoria"];
        }
        if(isset($_GET["nombre_numero"]) && $_GET["nombre_numero"]!=null){
            $filtroNombreNumero=$_GET["nombre_numero"];
            $corredores=Corredor::getResultado($categoriaSeleccionada,$filtroNombreNumero);
        }
        if($_GET["categoria"]=="general"){

            $categoriaSeleccionada=$_GET["categoria"];
            $carreraSeleccionadaEntero=self::getKilometroByFiltroCarrera($carreraSeleccionada,false);
            $corredores=Corredor::getResultado($carreraSeleccionadaEntero);


        }else{

            $corredores=Corredor::getResultado(null,$categoriaSeleccionada,null);

        }










        /*if(isset($_GET["categoria"]) && $_GET["categoria"]!=null){

            $categoriaSeleccionada=$_GET["categoria"];

            $corredores=Corredor::find()->where(['idCategoria'=>$categoriaSeleccionada])->andWhere(['tiempo']>0)->orderBy('tiempo')->all();

        }
        if(isset($_GET["categoria"]) && $_GET["categoria"]=="general"){
            $carreraSeleccionadaEntero=self::getKilometroByFiltroCarrera($carreraSeleccionada);
            $corredores=Corredor::find()->where(['kilometros'=>$carreraSeleccionadaEntero])->andWhere(['tiempo']>0)->orderBy('tiempo')->all();
        }*/


        return $this->render('new',['corredores'=>$corredores,'carreraSeleccionada'=>$carreraSeleccionada]);
    }

    public function actionCategorias(){
        $carrera=$_GET["carrera"];
         $filtroCarrera=self::getKilometroByFiltroCarrera($carrera);
         if($carrera=="equipo"){
             $categorias=Categoria::find()->where(['kilometros'=>$filtroCarrera])->andWhere(["equipo"=>1])->all();
         }else{
             $categorias=Categoria::find()->where(['kilometros'=>$filtroCarrera])->andWhere(["equipo"=>0])->all();
         }



         return Json::htmlEncode($categorias);

    }



    public static function getKilometroByFiltroCarrera($value){
        /*$valor=null;
        if($value==1){
           $valor=5;
        }
        if($value==2){
            $valor=5;
        }
        if($value==3){
            $valor=10;
        }*/
        $valor=null;
        if($value=="equipo"){
            $valor=5;
        }
        if($value=="5kindividual"){
            $valor=5;
        }
        if($value=="10kindividual"){
            $valor=10;
        }
        return $valor;
    }
}
