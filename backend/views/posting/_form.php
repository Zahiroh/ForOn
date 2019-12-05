<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Posting */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="posting-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idCategory')->textInput() ?>

    <?= $form->field($model, 'idUser')->textInput() ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mainPost')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ratingPosting')->textInput() ?>

    <?= $form->field($model, 'likePosting')->textInput() ?>

    <?= $form->field($model, 'dislikePosting')->textInput() ?>

    <?= $form->field($model, 'datePosted')->textInput() ?>

    <?= $form->field($model, 'filePosting')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
