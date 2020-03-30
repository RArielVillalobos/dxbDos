<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tiempo */

$this->title = 'Create Tiempo';
$this->params['breadcrumbs'][] = ['label' => 'Tiempos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tiempo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
