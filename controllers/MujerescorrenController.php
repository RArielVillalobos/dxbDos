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
        //se redirecciona a los resultados de mujerescorren 2020
        return $this->redirect(["resultado/evento/1"]);
    }

}
