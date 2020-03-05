<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Equipocorredor */

$this->title = 'Create Equipocorredor';
$this->params['breadcrumbs'][] = ['label' => 'Equipocorredors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipocorredor-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
