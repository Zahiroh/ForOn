<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CommentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Comments';
$this->params['breadcrumbs'][] = $this->title;
Yii::$app->params['notif'] = $notif;
?>
<div class="comments-index">
    <?php
        $data = $dataProvider2->getModels();
        foreach($data as $posting) {
    ?>
    <br></br>
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="media media-reply">
                        <img class="mr-3 circle-rounded" src="<?php echo Yii::$app->request->baseUrl ?>/images/avatar/<?php echo $posting['fotoUser']?>" width="50" height="50" alt="Generic placeholder image">
                            <div class="media-body">
                                <div class="d-sm-flex justify-content-between mb-2">
                                    <h5 class="mb-sm-0"><?php echo $posting['fullname']?><small class="text-muted ml-3"><?php echo $posting['datePosted']?></small></h5>
                                    <div class="media-reply__link">
                                                    <a href="<?php echo Url::to(['posting/like', 'id'=>$posting['id']]) ?>"><button class="btn btn-transparent p-0 mr-3"><?php echo $posting['love'];?> <i class="fa fa-thumbs-up"></i></button></a>
                                                    <a href="<?php echo Url::to(['posting/dislike', 'id'=>$posting['id']]) ?>"><button class="btn btn-transparent p-0 mr-3"><?php echo $posting['dislike'];?> <i class="fa fa-thumbs-down"></i></button></a>
                                               
                                        <a class="fa fa-comments" href="./comments/index?idPost=<?php echo $posting['id'] ?>"></a>
                                           
                                    </div>
                                </div>
                                    <h5><?php echo $posting['title']?></h5>
                                    <p><?php echo $posting['mainPost']?></p>  
                                         <?= Html::a('', ['posting/download', 'id' => $posting['id']], ['class' => 'fa fa-download']) 
                                         ?>
                                         
                            </div>
                    </div>
                </div>
            </div>
         </div>
    </div>
    <?php }
         ?> 

    <div class="card col-sm-12">
        <div class="card-body">
        <?php
            $data2 = $dataProvider->getModels();
            // $data2 = $dataProvider3->getModels();
            // foreach($data as $comment) {
            // if($comment->idPosting == $posting['id']) {
               foreach($data2 as $comment) {
            //     if ($comment['idUser'] == $user['id']) {

        ?>
                                    
             <div class="media mt-3">
                <img class="mr-3 circle-rounded circle-rounded" src="<?php echo Yii::$app->request->baseUrl ?>/images/avatar/<?php echo $comment['fotoUser']?>" width="50" height="50" alt="Generic placeholder image">
                <div class="media-body">
                    <div class="d-sm-flex justify-content-between mb-2">
                        <h5 class="mb-sm-0"><?php echo $comment['fullname']?><small class="text-muted ml-3"><?php echo $comment['commentPosted']?></small></h5>
                    </div>
                     <p><?php echo $comment['mainComment']?></p>
                 </div>
                     <?php if ($comment['idUser'] == Yii::$app->user->GetId()) { ?>
                        <p>
                            <?= Html::a('Update', ['update', 'id' => $comment['id']], ['class' => 'btn btn-primary']) ?>
                            <?= Html::a('Delete', ['delete', 'id' => $comment['id']], ['class' => 'btn btn-danger','data' => ['confirm' => 'Are you sure you want to delete this item?','method' => 'post',],]) ?>
                        </p>
                    <?php } ?>
                 </div>
                 <?php 
                 }  ?>
                <p><hr>
                
                <?php if(!Yii::$app->user->isGuest) { ?>
                    <div class="comments-form">
                        <div class="row">
                            <div class=" col-xl-12">
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
                <?php } ?>
                </p></hr>            
        </div>
    </div>
</div>
