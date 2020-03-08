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

    <?= $form->field($model,'idCategoria')->dropDownList(yii\helpers\ArrayHelper::map(\app\models\Categoria::find()->all(),'idCategoria','nombreCategoria'))?>
    

    <?= $form->field($model,'idPersona')->dropDownList(yii\helpers\ArrayHelper::map(\app\models\Persona::find()->all(),'idPersona','dni')) ?>

   

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
