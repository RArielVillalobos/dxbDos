<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Categoria */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categoria-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model,'idCarrera')->dropDownList(yii\helpers\ArrayHelper::map(\app\models\Carrera::find()->all(),'idCarrera','nombre'))?>

    <?= $form->field($model, 'kilometros')->textInput() ?>

    <?= $form->field($model, 'nombreCategoria')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'equipo')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
