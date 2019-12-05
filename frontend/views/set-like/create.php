<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\SetLike */

$this->title = 'Create Set Like';
$this->params['breadcrumbs'][] = ['label' => 'Set Likes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="set-like-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
