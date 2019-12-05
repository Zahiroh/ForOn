<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Posting */

$this->title = 'Add Post';
$this->params['breadcrumbs'][] = ['label' => 'Postings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
Yii::$app->params['notif'] = $notif;
?>
<div class="posting-create">

    <h1><center><?= Html::encode($this->title) ?></center></h1>
    
    <?= $this->render('_form', [
        'model' => $model,
        'category' => $category,
        'notif' => $notif,
    ]) ?>

</div>
