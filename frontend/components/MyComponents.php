<?php
namespace frontend\components;
use Yii;
use yii\base\Component;
use frontend\models\Statistic;
use yii\web\Request;

class MyComponents extends Component{
    const EVENT = 'event';

    public function myHandler(){
        $model = new Statistic();
        $model->access_time = date("Y:m:d H:i:s");
        $model->user_ip = Yii::$app->request->userIP;
        $model->user_host = Yii::$app->request->getHostName();
        $model->path_info = Yii::$app->request->pathInfo;
        $model->query_string = Yii::$app->request->queryString;
        $model->save();
    }
}

?>