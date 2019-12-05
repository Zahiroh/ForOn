<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Comments */
/* @var $form yii\widgets\ActiveForm */
Yii::$app->params['notif'] = $notif;
?>

<div class="comments-form">
    <div class="row justify-content-center">
        <div class=" col-xl-8">
            <div class="card">
                <div class="card-body">
                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
                    <form action="#" class="form-profile">
                    <?= $form->field($model, 'mainComment')->textarea(['rows' => 2])->label('Your Comment : ') ?>
                        <div class="d-flex align-items-center">
                            <div class="form-group">
                                <?= Html::submitButton('Comment', ['class' => 'btn btn-primary px-3 ml-4']) ?>
                            </div>
                        </div>
                    </form>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
