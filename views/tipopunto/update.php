<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TipoPunto */

$this->title = 'Update Tipo Punto: ' . $model->idTipo;
$this->params['breadcrumbs'][] = ['label' => 'Tipo Puntos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idTipo, 'url' => ['view', 'id' => $model->idTipo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tipo-punto-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
