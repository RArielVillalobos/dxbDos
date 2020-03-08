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

            if($carreraSeleccionadaString=="equipo"){
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
        $carreraSeleccionada=$_GET["carrera"];
        $categoriaSeleccionada=1;
        $corredores=Corredor::find()->where(['idCategoria'=>$categoriaSeleccionada])->where(['tiempo']>0)->orderBy('tiempo')->all();
        if(isset($_GET["categoria"]) && $_GET["categoria"]!=null){

            $categoriaSeleccionada=$_GET["categoria"];

            $corredores=Corredor::find()->where(['idCategoria'=>$categoriaSeleccionada])->andWhere(['tiempo']>0)->orderBy('tiempo')->all();

        }
        if(isset($_GET["categoria"]) && $_GET["categoria"]=="general"){
            $carreraSeleccionadaEntero=self::getKilometroByFiltroCarrera($carreraSeleccionada);
            $corredores=Corredor::find()->where(['kilometros'=>$carreraSeleccionadaEntero])->andWhere(['tiempo']>0)->orderBy('tiempo')->all();
        }


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
    public function actionIndexOLdOld(){
        //control url
        //evita general equipos
        /*if(isset($_GET["carrera"])){
            if($_GET["carrera"]=="equipo" && $_GET["categoria"]=="general"){

                return $this->redirect(["mujerescorren/index",'carrera'=>'equipo','categoria'=>13]);
            }
        }*/



        //carrera
        if(isset($_GET["carrera"])){
            $carreraSeleccionada=$_GET["carrera"];
            $filtroCarrera=self::getKilometroByFiltroCarrera($_GET["carrera"]);
        }else{
            $filtroCarrera=5;
            $carreraSeleccionada="5kindividual";
        }

        //categoria
        //si la busqueda por categoria esta seteada
        if(isset($_GET["categoria"])){
            $categoriaSeleccionada=$_GET["categoria"];
        }else{
            $categoriaSeleccionada="general";
        }

        //CARGA COMBO FILTROS
        if($carreraSeleccionada=="equipo"){
            $categorias= Categoria::find()->where(['kilometros'=>5])->andWhere(['equipo'=>1])->all();
            //$corredores=Corredor::getCorredores()

        }else{
            $categorias= Categoria::find()->where(['kilometros'=>$filtroCarrera])->andWhere(['equipo'=>0])->all();

        }

        //si eligio clasificacion general
        if($categoriaSeleccionada=="general"){

            $corredores = Corredor::getCorredoresGeneral($filtroCarrera, 0);


        }else{


            $corredores=Corredor::getCorredores($categoriaSeleccionada);
        }






        return $this->render('index',['corredores'=>$corredores,'categorias'=>$categorias,'categoriaSeleccionada'=>$categoriaSeleccionada,'carreraSeleccionada'=>$carreraSeleccionada]);
    }
    public function actionIndexOld()
    {

        if(!isset($_GET["carrera"])){
            $filtroCarreraSeleccionada=$_GET["carrera"];
        }
        else{
            $filtroCarreraSeleccionada=self::CINCOK;
        }
        $filtroCarrera=(isset($_GET["carrera"]))?self::getKilometroByFiltroCarrera($filtroCarreraSeleccionada) : self::getKilometroByFiltroCarrera(self::CINCOK);

        if(!isset($_GET["categoria"])) {
            //select seleccionad
            $categoriaSeleccionada = "general";
            //CORREDORES GENERAL 5K INDIVIDUAL
            $corredores = Corredor::getCorredoresGeneral($filtroCarrera, 0);
        }
        if( $_GET["categoria"]=="general" ){
            $categoriaSeleccionada="general";
            //CORREDORES GENERAL 5K INDIVIDUAL
            $corredores=Corredor::getCorredoresGeneral($filtroCarrera,0);
        }
        //segun el filtro seleccionado
        else{
            $categoriaSeleccionada=$_GET["categoria"];
            $corredores=Corredor::getCorredores($categoriaSeleccionada);
        }
        if($filtroCarreraSeleccionada==1){
            $categorias= Categoria::find()->where(['kilometros'=>$filtroCarrera])->andWhere(['equipo'=>1])->all();
            //$corredores=Corredor::getCorredores()

        }else{
            $categorias= Categoria::find()->where(['kilometros'=>$filtroCarrera])->andWhere(['equipo'=>0])->all();

        }


        //$corredores=Corredor::find()->where(['idCategoria'=>$categoriaSeleccionada])->all();





        return $this->render('index',['corredores'=>$corredores,'categorias'=>$categorias,'filtroCarrera'=>$filtroCarreraSeleccionada,'categoriaSeleccionada'=>$categoriaSeleccionada]);
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
