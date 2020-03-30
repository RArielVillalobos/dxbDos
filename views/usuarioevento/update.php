<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UsuarioEvento */

$this->title = 'Update Usuario Evento: ' . $model->idUsuarioEvento;
$this->params['breadcrumbs'][] = ['label' => 'Usuario Eventos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idUsuarioEvento, 'url' => ['view', 'id' => $model->idUsuarioEvento]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="usuario-evento-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
