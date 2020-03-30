<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PuntoCheckSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Punto Checks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="punto-check-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Punto Check', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idPunto',
            'idCarrera',
            'nombre',
            'km',
            'idTipoPunto',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
