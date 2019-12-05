<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\User;
use frontend\models\Posting;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PostingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
Yii::$app->params['notif'] = $notif;
?>
<div class="posting-index">

    <br></br>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php if(!Yii::$app->user->isGuest) { ?>
        <div class="posting-form">
    <div class="row justify-content-center">
        <div class=" col-xl-12">
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
    <?php } ?>

    <div class="row">
        <?php
            $data = $dataProvider->getModels();
            foreach($data as $posting) {
        ?>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="media media-reply">
                        <img class="mr-3 circle-rounded" src="<?php echo Yii::$app->request->baseUrl ?>/images/avatar/<?php echo $posting['fotoUser']?>" width="50" height="50" alt="Generic placeholder image">
                            <div class="media-body">
                                <div class="d-sm-flex justify-content-between mb-2 col-12">
                                        <h5 class="mb-sm-0"><?php echo $posting['fullname']?><small class="text-muted ml-3"><?php echo $posting['datePosted']?></small></h5>
                                            <div class="media-reply__link">
                                                <a href="<?php echo Url::to(['posting/like', 'id'=>$posting['id']]) ?>"><button class="btn btn-transparent p-0 mr-3"><?php echo $posting['love'];?><i class="fa fa-thumbs-up"></i></button></a>
                                                <a href="<?php echo Url::to(['posting/dislike', 'id'=>$posting['id']]) ?>"><button class="btn btn-transparent p-0 mr-3"><?php echo $posting['dislike'];?><i class="fa fa-thumbs-down"></i></button></a>
                                                <a class="fa fa-comments" href="../comments/index?idPost=<?php echo $posting['id'] ?>"></a>
                                                
                                            </div>
                                        </div>
                                        <h5><?php echo $posting['title']?></h5>
                                        <p><?php echo $posting['mainPost']?></p>
                                </div>
                                <?php if ($posting['idUser'] == Yii::$app->user->GetId()) { ?>
                                            <p>
                                                <?= Html::a('Update', ['update', 'id' => $posting['id']], ['class' => 'ml-3 btn btn-primary']) ?>
                                                <?= Html::a('Delete', ['delete', 'id' => $posting['id']], [
                                                    'class' => 'btn btn-danger',
                                                    'data' => [
                                                        'confirm' => 'Are you sure you want to delete this item?',
                                                        'method' => 'post',
                                                    ],
                                                ]) ?>
                                            </p>
                                        <?php } ?>
                            </div>
                        </div>
                    </div>
                    </div>
            <?php } 
             ?>
    </div>
</div>