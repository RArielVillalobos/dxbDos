<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Equipocorredor */

$this->title = 'Update Equipocorredor: ' . $model->idEquipoCorredor;
$this->params['breadcrumbs'][] = ['label' => 'Equipocorredors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idEquipoCorredor, 'url' => ['view', 'id' => $model->idEquipoCorredor]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="equipocorredor-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
