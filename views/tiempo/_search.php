<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TiempoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tiempo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idTiempo') ?>

    <?= $form->field($model, 'idPunto') ?>

    <?= $form->field($model, 'tiempo') ?>

    <?= $form->field($model, 'idUsuario') ?>

    <?= $form->field($model, 'numCorredor') ?>

    <?php // echo $form->field($model, 'idCorredor') ?>

    <?php // echo $form->field($model, 'idFuente') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
