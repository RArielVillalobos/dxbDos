<?php

namespace app\controllers;

use app\models\Corredor;
use app\models\CorredorSearch;
use yii;
use app\models\Equipo;
use app\models\Result;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\Permiso;
use app\models\ResultSearch;
use yii\web\NotFoundHttpException;


/**
 * Controlador utilizado para armar y mostrar las encuestas
 */

class BotController extends Controller{
    public function actionIndex($id){
       

        //https://api.telegram.org/bot922193529:AAHHRBwHvKWOkPWgmNvWFD6_YTHdZ8mrRl8/setwebhook?url=https://dxb.fi.uncoma.edu.ar/AAHHRBwHvKWOkPWgmNvWFD6_YTHdZ8mrRl8.php


        $ruta='chatbot';

        $json= file_get_contents("$ruta/$id.json");

        $date = date('Y-m-d H:i:s');

		echo $date; 

          $data = json_decode($json, TRUE);
        $guardados=0;
        $noGuardados=0;
        foreach($data as $dat){
            $corredor=Corredor::findOne(['numCorredor'=>$dat["numEquipo"]]);
            if(!$corredor){
                $corredor->tiempo=$dat["tiempoLlegada"];
                $corredor->save();
                $guardados++;

            }



               /* $corredor=Corredor::findOne(['numCorredor'=>$dat['numEquipo']]);
                if($corredor!=null){
                    $corredor->tiempo=$dat["tiempo"];
                    $corredor->save();
                    $guardados++;
                }*/
               //echo $valor[$clave]["numEquipo"];
               //echo "<pre></pre>";


                //num equipo y tiempo
                //$corredor=


            //$guardados=$guardados+1;
            //echo $guardados;
        }

        echo 'cargados Corectamente ';
        echo '<hr>';
        //echo 'No cargados '. $noGuardados;

    }

}

