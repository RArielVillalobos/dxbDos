<?php

namespace app\controllers;

class MujerescorrenController extends \yii\web\Controller
{
    //public $layout="";

    public function init()

    {

        $this->layout = false;

    }

    public function actionIndex()
    {
        return $this->render('index');
    }

}
