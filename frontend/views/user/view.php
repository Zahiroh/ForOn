<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\models\User */

$this->title = $model->fullname;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

Yii::$app->params['notif'] = $dataProvider3;
?>
<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="media align-items-center mb-4">
                                    <img class="mr-3 circle-rounded" src="<?php echo Yii::$app->request->baseUrl ?>/images/avatar/<?php echo $model->fotoUser; ?>" width="80" height="80" alt="">
                                    <div class="media-body">
                                        <h3 class="mb-0"><?php echo $model->fullname; ?></h3>
                                        <p class="text-muted mb-0"><?php echo $model->username; ?></p>
                                    </div>
                                </div>
                                
                                <div class="row mb-5">
                                    <?php if($model->id!=Yii::$app->user->getID()){?>
                                    <div class="col-12 text-center">
                                        <button class="btn btn-rounded btn-danger px-5">About Me</button>
                                    </div>
                                    <?php } 
                                    else {?>
                                    <div class="col-12 text-center">
                                        <a href="<?php echo Url::to(['user/update','id' => $model->id]); ?>"><button class="btn btn-rounded btn-danger px-5">Edit Profile</button></a>
                                    </div>
                                    <?php } ?>
                                </div>

                                <h4>About Me</h4>
                                <p class="text-muted"><?php echo $model->deskripsi; ?></p>
                                <ul class="card-profile__info">
                                    <!-- <li class="mb-1"><strong class="text-dark mr-4">Mobile</strong> <span>01793931609</span></li> -->
                                    <li><strong class="text-dark mr-4">Email</strong> <span><?php echo $model->email; ?></span></li>
                                </ul>
                            </div>
                        </div>  
                    </div>
                    
                    <!--posting start-->
                    <div class="col-lg-8 col-xl-9">
                        <?php if($model->id==Yii::$app->user->getID()){?>
                        <div class="col-12 text-center">
                            <a href="<?php echo Url::to(['posting/create']); ?>"><button class="btn btn-outline-primary px-5 btn-block btn-light">New Post</button></a>
                        </div>
                        <?php } 
                        ?>
                        <br>
                        <?php 
                        //$data = $dataProvider->getModels();
                        foreach($row->getModels() as $posting){
                        ?>
                        <div class="card">
                            <div class="card-body">
                                <div class="media media-reply">
                                    <img class="mr-3 circle-rounded" src="<?php echo Yii::$app->request->baseUrl ?>/images/avatar/<?php echo $model->fotoUser; ?>" width="50" height="50" alt="Generic placeholder image">
                                    <div class="media-body">
                                        <div class="d-sm-flex justify-content-between mb-2">
                                            <h5 class="mb-sm-0"><?php echo $model->fullname; ?><small class="text-muted ml-3"><?php echo $posting['datePosted'];?></small></h5>
                                            <div class="media-reply__link">
                                                <a href="<?php echo Url::to(['posting/like', 'id'=>$posting['id']]) ?>"><button class="btn btn-transparent p-0 mr-3"><?php echo $posting['love'];?> <i class="fa fa-thumbs-up"></i></button></a>
                                                <a href="<?php echo Url::to(['posting/dislike', 'id'=>$posting['id']]) ?>"><button class="btn btn-transparent p-0 mr-3"><?php echo $posting['dislike'];?> <i class="fa fa-thumbs-down"></i></button></a>
                                                <a class="fa fa-comments" href="./comments/index?idPost=<?php echo $posting['id'] ?>"></a>
                                            </div>
                                        </div>
                                        <h4><?php echo $posting['title'];?></h4>
                                        <p><?php echo $posting['mainPost'];?></p>
                                        <a href="<?php echo Url::to(['comments/index','idPost' => $posting['id']]); ?>"><button type="button" class="btn mb-1 btn-outline-primary">Read More</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php  } ?>
                        </div>
                    </div>
                    <!-- posting end-->
                </div>
            </div>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
<div class="user-view">

    <!-- <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'auth_key',
            'password_hash',
            'password_reset_token',
            'email:email',
            'status',
            'created_at',
            'updated_at',
            'verification_token',
            'rolesId',
        ],
    ]) ?> -->

</div>
