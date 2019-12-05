<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\User */
/* @var $form yii\widgets\ActiveForm */
Yii::$app->params['notif'] = $dataProvider3;
?>
<br></br>
<div class="user-form">
    <div class="row justify-content-center">
        <div class=" col-xl-8">
            <div class="card">
                <div class="card-body">


    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'fullname')->textInput(['maxlength' => true]) ?>

    <!--<?= $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?>-->

    <!--<?= $form->field($model, 'password_hash')->textInput(['maxlength' => true]) ?>-->

    <!--<?= $form->field($model, 'password_reset_token')->textInput(['maxlength' => true]) ?>-->

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <!--<?= $form->field($model, 'status')->textInput() ?>-->

    <!--<?= $form->field($model, 'created_at')->textInput() ?>-->

    <!--<?= $form->field($model, 'updated_at')->textInput() ?>-->

   <!-- <?= $form->field($model, 'verification_token')->textInput(['maxlength' => true]) ?>-->

    <!--<?= $form->field($model, 'rolesId')->textInput() ?>-->

    <?= $form->field($model, 'deskripsi')->textArea(['rows' => '6']) ?>
    
    <?= $form->field($model, 'fotoUser')->fileInput() ?>
    
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>

</div>
