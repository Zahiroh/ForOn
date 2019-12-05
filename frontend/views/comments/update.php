<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Comments */

$this->title = 'Update Comments: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Comments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
Yii::$app->params['notif'] = $notif;
?>
<div class="comments-update">
    <br></br>
    <?= $this->render('_form', [
        'model' => $model,
        'notif' => $notif,
    ]) ?>

</div>
