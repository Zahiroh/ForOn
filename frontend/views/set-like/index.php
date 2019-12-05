<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\SetLikeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Set Likes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="set-like-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Set Like', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'postId',
            'userId',
            'ike',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
