<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\User */
/* @var $form yii\widgets\ActiveForm */
Yii::$app->params['notif'] = $dataProvider3;
$this->title = 'Update User ' . $model->fullname;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<br>
<div class="user-form">
    <div class="user-form">
        <div class="row justify-content-center">
            <div class=" col-xl-8">
                <div class="card">
                    <div class="card-body">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'password_hash')->textInput(['maxlength' => true]) ?>
    
    
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>

</div>
