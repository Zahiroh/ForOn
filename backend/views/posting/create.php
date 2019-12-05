<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Posting */

$this->title = 'Create Posting';
$this->params['breadcrumbs'][] = ['label' => 'Postings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posting-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
