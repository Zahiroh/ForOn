<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
Yii::$app->params['notif'] = $dataProvider3;
?>
<div class="user-index">
    <!--
    <h1><?= Html::encode($this->title) ?></h1>-->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!--
    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>-->
    <br>
    <div class="row">
        <?php 
        //$data = $dataProvider->getModels();
        //print_r($row);
        foreach($row as $user){
        ?>
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <img alt="" class="rounded-circle mt-4" src="<?php echo Yii::$app->request->baseUrl ; ?>/images/avatar/<?php echo $user['fotoUser']; ?>">
                        <h4 class="card-widget__title text-dark mt-3"><?php echo $user['fullname']?></h4>
                        <p class="text-muted"><?php echo $user['roleName']?></p>
                        <a class="btn gradient-4 btn-lg border-0 btn-rounded px-5" href="<?php echo Url::to(['user/index', 'id'=>$user['idUser'] ]);?>">Visit</a>
                    </div>
                </div>
                <div class="card-footer border-0 bg-transparent">
                    <div class="row">
                        <div class="col-4 border-right-1 pt-3">
                            <a class="text-center d-block text-muted" href="javascript:void()">
                                <i class="fa fa-star gradient-1-text" aria-hidden="true"></i>
                                <p class=""><?php echo $user['posting']?> Post</p>
                            </a>
                        </div>
                        <div class="col-4 border-right-1 pt-3"><a class="text-center d-block text-muted" href="javascript:void()">
                            <i class="fa fa-heart gradient-3-text"></i>
                                <p class=""><?php echo $user['komentar']?> Comments</p>
                            </a>
                        </div>
                        <div class="col-4 pt-3"><a class="text-center d-block text-muted" href="javascript:void()">
                            <i class="fa fa-envelope gradient-4-text"></i>
                                <p class="">Email</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
