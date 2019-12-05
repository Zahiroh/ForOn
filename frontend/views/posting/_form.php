<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Posting */
/* @var $form yii\widgets\ActiveForm */
Yii::$app->params['notif'] = $notif;
?>

<div class="posting-form">
    <div class="row justify-content-center">
        <div class=" col-xl-8">
            <div class="card">
                <div class="card-body">
                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
                    <form action="#" class="form-profile">
                    <?= $form->field($model, 'idCategory')->dropDownList($category, ['prompt' => '-Choose Category-'])->label('Kategori') ?>
                    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'mainPost')->textarea(['rows' => 6])->label('Write Your Post') ?>
                        <div class="d-flex align-items-center">
                        <?= $form->field($model, 'filePosting')->fileInput() ?>
                            <div class="form-group">
                                <?= Html::submitButton('Post', ['class' => 'btn btn-primary px-3 ml-4']) ?>
                            </div>
                        </div>
                    </form>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
