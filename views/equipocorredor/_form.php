<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Equipocorredor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="equipocorredor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idEquipo')->textInput() ?>

    <?= $form->field($model, 'idCorredor')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
