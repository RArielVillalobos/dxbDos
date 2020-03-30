<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Fuente */

$this->title = 'Update Fuente: ' . $model->idFuente;
$this->params['breadcrumbs'][] = ['label' => 'Fuentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idFuente, 'url' => ['view', 'id' => $model->idFuente]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fuente-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
