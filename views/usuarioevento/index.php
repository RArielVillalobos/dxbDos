<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuarioEventoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuario Eventos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-evento-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Usuario Evento', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idUsuarioEvento',
            'idUsuario',
            'idEvento',
            'idRol',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
