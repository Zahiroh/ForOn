<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\User */

$this->title = 'Update User: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';

Yii::$app->params['notif'] = $dataProvider3;
?>
<div class="user-update">

    <?= $this->render('_form', [
        'model' => $model,
        'dataProvider3' => $dataProvider3,
    ]) ?>

</div>
