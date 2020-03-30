<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UsuarioEventoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuario-evento-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idUsuarioEvento') ?>

    <?= $form->field($model, 'idUsuario') ?>

    <?= $form->field($model, 'idEvento') ?>

    <?= $form->field($model, 'idRol') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
