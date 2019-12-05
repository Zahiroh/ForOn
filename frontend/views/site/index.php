<?php

/* @var $this yii\web\View */
use frontend\models\Item;
use yii\helpers\Html;
use yii\helpers\Url;

//print_r($items); die();
$this->title = 'ForOn';
$this->params['breadcrumbs'][] = $this->title;
Yii::$app->params['notif'] = $notif;
?>

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            <div class="container-fluid mt-3">
                <div class="row">
                <?php
                $data = $dataProvider->getModels();
                $i=1;
                foreach($data as $category){
                ?>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-<?php echo $i; ?>">
                        <a href="posting/index?idCategory=<?php echo $category->id ?>">
                            <div class="card-body" >
                                <h3 class="card-title text-white"></h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white"><?php echo $category->categoryName?></h2>
                                </div>
                            </div>
                            </a>
                        </div>
                    </div>
                <?php $i++; } ?>
                </div>
                    
                <div class="row">
                    <div class="col-xl-12">
                    <?php foreach($dataProvider2->getModels() as $posting){?>
                        <div class="card">
                            <div class="card-body">    
                                <div class="media media-reply">
                                    <img class="mr-3 circle-rounded" src="<?php echo Yii::$app->request->baseUrl ?>/images/avatar/<?php echo $posting['fotoUser']; ?>" width="50" height="50" alt="Generic placeholder image">
                                    <div class="media-body">
                                        <div class="d-sm-flex justify-content-between mb-2">
                                            <h5 class="mb-sm-0"><?php echo $posting['fullname'];?><small class="text-muted ml-3"><?php echo $posting['datePosted'];?></small></h5>
                                            <div class="media-reply__link">
                                                <a href="<?php echo Url::to(['posting/like', 'id'=>$posting['id']]) ?>"><button class="btn btn-transparent p-0 mr-3"><?php echo $posting['love'];?> <i class="fa fa-thumbs-up"></i></button></a>
                                                <a href="<?php echo Url::to(['posting/dislike', 'id'=>$posting['id']]) ?>"><button class="btn btn-transparent p-0 mr-3"><?php echo $posting['dislike'];?> <i class="fa fa-thumbs-down"></i></button></a>
                                                <a class="fa fa-comments" href="./comments/index?idPost=<?php echo $posting['id'] ?>"></a>
                                            </div>
                                        </div>
                                        <p><u><?php echo $posting['title'];?></u></p>
                                        <p><?php echo $posting['mainPost'];?></p>
                                        <a href="<?php echo Url::to(['comments/index','idPost' => $posting['id']]); ?>"><button type="button" class="btn mb-1 btn-outline-primary">Read More</button></a>
                                    </div>
                                    <?php if ($posting['idUser'] == Yii::$app->user->GetId()) { ?>
                                            <p>
                                                <?= Html::a('Update', ['posting/update', 'id' => $posting['id']], ['class' => 'ml-3 btn btn-primary']) ?>
                                                <?= Html::a('Delete', ['posting/de
                                                lete', 'id' => $posting['id']], [
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
                        <?php } ?>
                    </div>
                </div>
                

                
            </div>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
        
        
        <!--**********************************
            Footer start
        ***********************************
        <div class="footer">
            <div class="copyright">
                <p>Copyright &copy; Designed & Developed by <a href="https://themeforest.net/user/quixlab">Quixlab</a> 2018</p>
            </div>
        </div>
        **********************************
            Footer end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!--
    <script src="plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script> -->

    <!-- Chartjs 
    <script src="./plugins/chart.js/Chart.bundle.min.js"></script> -->
    <!-- Circle progress 
    <script src="./plugins/circle-progress/circle-progress.min.js"></script> -->
    <!-- Datamap 
    <script src="./plugins/d3v3/index.js"></script>
    <script src="./plugins/topojson/topojson.min.js"></script>
    <script src="./plugins/datamaps/datamaps.world.min.js"></script>-->
    <!-- Morrisjs 
    <script src="./plugins/raphael/raphael.min.js"></script>
    <script src="./plugins/morris/morris.min.js"></script>-->
    <!-- Pignose Calender 
    <script src="./plugins/moment/moment.min.js"></script>
    <script src="./plugins/pg-calendar/js/pignose.calendar.min.js"></script> -->
    <!-- ChartistJS 
    <script src="./plugins/chartist/js/chartist.min.js"></script>
    <script src="./plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js"></script>
-->
<!--
    <script src="./js/dashboard/dashboard-1.js"></script> -->

