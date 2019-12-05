<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Roleuser */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="roleuser-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'roleName')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
