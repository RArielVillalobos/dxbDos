<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tiempo */

$this->title = 'Update Tiempo: ' . $model->idTiempo;
$this->params['breadcrumbs'][] = ['label' => 'Tiempos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idTiempo, 'url' => ['view', 'id' => $model->idTiempo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tiempo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
