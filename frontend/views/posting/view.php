<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Posting */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Postings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
Yii::$app->params['notif'] = $notif;
?>
<div class="posting-view">
<?php $posting = $model;
    //print_r($posting);?>
    <div class="row justify-content-center">
        <div class="col-sm-8">
            <div class="card">
                <img class="img-fluid" style="max-width: 100%; height: auto; display: block; max-height: 300pt;" src="<?php echo Yii::$app->request->baseUrl ?>/images/big/<?php echo $posting->filePosting;?>" alt="">
                <div class="card-body">
                    <h2 class="card-title"><?php echo $posting['title'];?></h2>
                    <p class="card-text"><?php echo $posting['mainPost'];?></p>
                    <p class="card-text"><small class="text-muted">Last updated <?php echo $posting['datePosted'];?></small>
                    </p>
                </div>
            </div>
        </div>
        
        <!-- komentar-->
    <div class="card col-sm-8">
        <div class="card-body">
        <?php foreach ($dataProvider->getModels() as $komentar){?>
        <div class="media media-reply">
            <img class="mr-3 circle-rounded" src="<?php echo Yii::$app->request->baseUrl ?>/images/avatar/<?php echo $komentar['fotoUser'];?>" width="50" height="50" alt="Generic placeholder image">
            <div class="media-body">
                <div class="d-sm-flex justify-content-between mb-2">
                    <h5 class="mb-sm-0"><?php echo $komentar['fullname'];?> <small class="text-muted ml-3"><?php echo $komentar['commentPosted'];?></small></h5>
                    <div class="media-reply__link">
                        <button class="btn btn-transparent p-0 mr-3"><i class="fa fa-thumbs-up"></i></button>
                        <button class="btn btn-transparent p-0 mr-3"><i class="fa fa-thumbs-down"></i></button>
                        <button class="btn btn-transparent p-0 ml-3 font-weight-bold">Reply</button>
                    </div>
                </div>
                
                <p><?php echo $komentar['mainComment'];?></p>
            </div>
        </div>
        <?php } ?>

        <!-- komentar-->
        <?php if(!Yii::$app->user->isGuest){?>
        <div class="media mt-3">
            <div class="media-body">
            <form action="<?php //echo Url::to(['comments/create2']); ?>" class="form-profile">
                <div class="form-group">
                    <textarea class="form-control" name="mainPost" id="mainPost" cols="30" rows="2" placeholder="Post a new message"></textarea>
                </div>
                <div class="d-flex align-items-center">
                    <button class="btn btn-primary px-3 ml-4" type="submit">Send</button>
                </div>
            </form>
            </div>
        </div>
        <?php } ?>

        <!-- komentar-->

    </div>
        <!-- End Col -->
    </div>

    
</div>

    <h1><?= Html::encode($this->title) ?></h1>

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
            'idCategory',
            'idUser',
            'title',
            'mainPost:ntext',
            'ratingPosting',
            'likePosting',
            'dislikePosting',
            'datePosted',
            'filePosting',
        ],
    ]) ?>

</div>
