<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TiempoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tiempos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tiempo-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Tiempo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idTiempo',
            'idPunto',
            'tiempo',
            'idUsuario',
            'numCorredor',
            //'idCorredor',
            //'idFuente',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
