<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Roleuser */

$this->title = 'Update Roleuser: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Roleusers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="roleuser-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
