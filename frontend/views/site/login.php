<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
Yii::$app->params['notif'] = $notif;
?>

<div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">
                                <a class="text-center" href="<?=Url::to('/yiiajie/Forum/frontend/web/site/login'); ?>"> <h2>LOGIN</h2></a>
        
                                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                                    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                                    <?= $form->field($model, 'password')->passwordInput() ?>

                                    <?= $form->field($model, 'rememberMe')->checkbox() ?>

                                    <div style="color:#999;margin:1em 0">
                                        If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
                                    </div>

                                    <div class="form-group">
                                        <?= Html::submitButton('Login', ['class' => 'btn login-form__btn submit w-100', 'name' => 'login-button']) ?>
                                    </div>

                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
