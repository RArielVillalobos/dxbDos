<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PuntoCheck */

$this->title = 'Update Punto Check: ' . $model->idPunto;
$this->params['breadcrumbs'][] = ['label' => 'Punto Checks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idPunto, 'url' => ['view', 'id' => $model->idPunto]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="punto-check-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
