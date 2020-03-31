<?php

namespace app\modules\api\controllers;

use app\models\Corredor;
use app\models\Evento;
use app\modules\api\models\Tiempo;
use yii\web\Response;

class TiempoController extends \yii\web\Controller
{
    public $enableCsrfValidation=false;
    public function actionIndex()
    {
        \Yii::$app->response->format=Response::FORMAT_JSON;
        return $this->ultimoEvento();
        //return ['status'=>true,'data'=>null,'mensaje'=>"api funcionando"];
        //return $this->render('index');
    }

    public function actionNuevo(){
        \Yii::$app->response->format=Response::FORMAT_JSON;
        $formatoLargada = 'Y-m-d H:i:s';
        $formatoLlegada='Y-m-d H:i:s.u';
        var_dump(\Yii::$app->request->post());
        die();
        //$idPunto=\Yii::$app->request->post()["idPunto"];
        $corredores=$this->multiCorredor(\Yii::$app->request->post()["numCorredor"]);
        $colTiempos=[];
        foreach ($corredores as $numCorredor){
            $tiempoLlegada=\Yii::$app->request->post()["tiempoLlegada"];
            $tiempoLlegadaCorredor = \DateTime::createFromFormat($formatoLlegada, $tiempoLlegada);
            var_dump($tiempoLlegadaCorredor);
            var_dump(\DateTime::getLastErrors());
            die();
            $tiempo=new \app\models\Tiempo();
            $tiempo->idPunto=1;
            $tiempo->tiempo=$tiempoLlegadaCorredor->format($formatoLlegada);
            $tiempo->idUsuario=1;
            $tiempo->numCorredor=(int)$numCorredor;
            $corredor=$this->obtenerCorredorUltimoEvento((int)$numCorredor);
            //SI EL CORREDOR ESTA ACREDITADO SE SETEA EL TIEMPO EN MILISEGUNDOS
            if($corredor!=false){
                $tiempoLargadaCarrera=\DateTime::createFromFormat($formatoLargada, $corredor["largada"]);
                $diff=$tiempoLlegadaCorredor->diff($tiempoLargadaCarrera);
                $corredor=Corredor::find()->where(["idCorredor"=>$corredor["idCorredor"]])->one();
                $tiempo->idCorredor=$corredor->idCorredor;

                $corredor->tiempo=(int)$this->toMilisegundos($diff);
                $corredor->save();
                //return ['status'=>true,'data'=>$tiempo];
            }
            if($tiempo->save()){
                $colTiempos[]=$tiempo;
            }

        }

        return ['status'=>true,'data'=>$colTiempos,'mensaje'=>"insertados:".count($colTiempos)];

    }
    private function toMilisegundos($interval){
        $totalMiliseconds = 0;
        $totalMiliseconds += $interval->m * 2630000000;
        $totalMiliseconds += $interval->d * 86400000;
        $totalMiliseconds += $interval->h * 3600000;
        $totalMiliseconds += $interval->i * 60000;
        $totalMiliseconds += $interval->s * 1000;
        $totalMiliseconds += explode("0.",$interval->f)[1]/1000;
        //$totalMiliseconds+=$interval->f*
        return $totalMiliseconds;

    }
    private function multiCorredor($stringCorredor){
       $arregloCorredores=explode("-",$stringCorredor);
       return $arregloCorredores;

    }
    private function ultimoEvento(){
       return  $ultimoEvento=Evento::find()->orderBy(['idEvento' => SORT_DESC])->one();
    }

    private function obtenerCorredorUltimoEvento($numCorredor){
        $idUltimoEvento=$this->ultimoEvento()->idEvento;
        $corredor=\Yii::$app->getDb()->createCommand("SELECT c.idCorredor,c.numCorredor,car.largada FROM corredor AS c
                INNER JOIN categoria AS cat ON c.idCategoria=cat.idCategoria
                INNER JOIN carrera AS car ON cat.idCarrera=car.idCarrera 
                INNER JOIN evento AS e ON car.idEvento=e.idEvento WHERE c.numCorredor=$numCorredor AND e.idEvento=$idUltimoEvento")->queryOne();
        return $corredor;
    }
    

}
