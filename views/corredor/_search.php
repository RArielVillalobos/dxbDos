<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CorredorSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="corredor-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idCorredor') ?>

    <?= $form->field($model, 'numCorredor') ?>

    <?= $form->field($model, 'idCategoria') ?>

    <?= $form->field($model, 'idPersona') ?>

    <?= $form->field($model, 'tiempo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
