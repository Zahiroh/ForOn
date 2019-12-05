<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RoleuserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Roleusers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="roleuser-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Roleuser', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'roleName',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
