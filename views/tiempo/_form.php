<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Tiempo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tiempo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idPunto')->textInput() ?>

    <?= $form->field($model, 'tiempo')->textInput() ?>

    <?= $form->field($model, 'idUsuario')->textInput() ?>

    <?= $form->field($model, 'numCorredor')->textInput() ?>

    <?= $form->field($model, 'idCorredor')->textInput() ?>

    <?= $form->field($model, 'idFuente')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
