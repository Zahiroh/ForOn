<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PostingSearch */
/* @var $form yii\widgets\ActiveForm */
Yii::$app->params['notif'] = $notif;
?>

<div class="posting-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'idCategory') ?>

    <?= $form->field($model, 'idUser') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'mainPost') ?>

    <?php // echo $form->field($model, 'ratingPosting') ?>

    <?php // echo $form->field($model, 'likePosting') ?>

    <?php // echo $form->field($model, 'dislikePosting') ?>

    <?php // echo $form->field($model, 'datePosted') ?>

    <?php // echo $form->field($model, 'filePosting') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
