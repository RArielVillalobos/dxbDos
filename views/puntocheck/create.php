<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PuntoCheck */

$this->title = 'Create Punto Check';
$this->params['breadcrumbs'][] = ['label' => 'Punto Checks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="punto-check-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
