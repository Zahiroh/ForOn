<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Posting */

$this->title = 'Update Posting: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Postings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="posting-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
