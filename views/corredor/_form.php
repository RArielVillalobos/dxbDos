<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Corredor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="corredor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'numCorredor')->textInput() ?>

    <?= $form->field($model, 'idCategoria')->textInput() ?>

    <?= $form->field($model, 'idPersona')->textInput() ?>

    <?= $form->field($model, 'tiempo')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
