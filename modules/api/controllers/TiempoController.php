<?php

namespace app\modules\api\controllers;

use app\models\Corredor;
use app\modules\api\models\Tiempo;
use yii\web\Response;

class TiempoController extends \yii\web\Controller
{
    public $enableCsrfValidation=false;
    public function actionIndex()
    {
        \Yii::$app->response->format=Response::FORMAT_JSON;
        return ['status'=>true,'data'=>null,'mensaje'=>"api funcionando"];
        //return $this->render('index');
    }

    public function actionNuevo(){
        \Yii::$app->response->format=Response::FORMAT_JSON;
        $idPunto=\Yii::$app->request->post()["idPunto"];
        $idUsu=\Yii::$app->request->post()["idUser"];
        $numCorredor=(int)\Yii::$app->request->post()["numCorredor"];
        $tiempoLlegada=\Yii::$app->request->post()["tiempoLlegada"];
        $formatoLargada = 'Y-m-d H:i:s';
        $formatoLlegada='Y-m-d H:i:s.u';
        $tiempoLlegadaCorredor = \DateTime::createFromFormat($formatoLlegada, $tiempoLlegada);
        $tiempo=new \app\models\Tiempo();
        $tiempo->idPunto=$idPunto;
        $tiempo->tiempo=$tiempoLlegadaCorredor->format($formatoLlegada);
        $tiempo->idUsuario=1;
        $tiempo->numCorredor=$numCorredor;
        //$corredorBD=Corredor::find()->where(["numCorredor"])
        if($tiempo->save()){
            $tiempoLargadaCarrera=\DateTime::createFromFormat($formatoLargada, $tiempo->idPunto0->idCarrera0->largada);
            $idCarrera=(int)$tiempo->idPunto0->idCarrera0->idCarrera;
            $corredor=\Yii::$app->getDb()->createCommand("SELECT * from corredor INNER JOIN categoria ON corredor.idCategoria=categoria.idCategoria WHERE categoria.idCarrera=$idCarrera AND corredor.numCorredor=$numCorredor")->queryOne();

            if($corredor!=false){
                $diff=$tiempoLlegadaCorredor->diff($tiempoLargadaCarrera);
                $corredor=Corredor::find()->where(["idCorredor"=>$corredor["idCorredor"]])->one();
                $tiempo->idCorredor=$corredor->idCorredor;
                $tiempo->save();
                $corredor->tiempo=(int)$this->toMilisegundos($diff);
                $corredor->save();
                //print_r($corredor->getErrors());
                echo "ok";
            }


            return ['status'=>true,'data'=>$tiempo];
        }else{
            return ['status'=>true,'data'=>$tiempo->getErrors()];

        }

        //die();

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
    

}
