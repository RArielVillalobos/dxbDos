<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PuntoCheckSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="punto-check-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idPunto') ?>

    <?= $form->field($model, 'idCarrera') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'km') ?>

    <?= $form->field($model, 'idTipoPunto') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
