<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PuntoCheck */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="punto-check-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idCarrera')->textInput() ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'km')->textInput() ?>

    <?= $form->field($model, 'idTipoPunto')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
