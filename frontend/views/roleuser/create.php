<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Roleuser */

$this->title = 'Create Roleuser';
$this->params['breadcrumbs'][] = ['label' => 'Roleusers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="roleuser-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
