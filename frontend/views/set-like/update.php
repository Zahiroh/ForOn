<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\SetLike */

$this->title = 'Update Set Like: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Set Likes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="set-like-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
