<?php

namespace app\controllers;

use app\models\Corredor;
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


        $ruta='/chatbot';

        $json= file_get_contents("$ruta/$id.json");

        $date = date('Y-m-d H:i:s');

		echo $date; 

                $data = json_decode($json, TRUE);
        $guardados=0;
        $noGuardados=0;
        foreach($data as $dat){
            //si no existe el equipo en la base se carga

                //es numero de corredor
                $corredor=Corredor::findOne(['numcorredor'=>$dat['numEquipo']]);
                $corredor->tiempo=$dat["tiempo"];
                $corredor->save();

                //num equipo y tiempo
                //$corredor=

            $noGuardados++;
            //$guardados=$guardados+1;
            //echo $guardados;
        }

        echo 'cargados Corectamente '. $guardados;
        echo '<hr>';
        //echo 'No cargados '. $noGuardados;

    }

}

