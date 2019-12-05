<?php

/* @var $this \yii\web\View */
/* @var $content string */


use frontend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="icon" type="image/png" sizes="16x16" href="">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

<div class="wrap">
    
<!--**********************************
        Nav header start
    ***********************************-->
    <div class="nav-header">
        <div class="brand-logo">
            <a href="index.html">
                <b class="logo-abbr"><img src="<?php echo Yii::$app->request->baseUrl ?>" alt=""> </b>
                <span class="logo-compact"><img src="<?php echo Yii::$app->request->baseUrl ?>" alt=""></span>
                <span class="brand-title">
                    <img src="<?php echo Yii::$app->request->baseUrl ?>images/logo-text.png" alt="">
                </span>
            </a>
        </div>
    </div>
    <!--**********************************
        Nav header end
    ***********************************-->

    <!--**********************************
        Header start
    ***********************************-->
    <div class="header">    
        <div class="header-content clearfix">

            <div class="nav-control">
                <div class="hamburger">
                    <span class="toggle-icon"><i class="icon-menu"></i></span>
                </div>
            </div>
            <!-- <?php if(!Yii::$app->user->isGuest){?>
            <div class="header-left">
                <div class="input-group-prepend">
                        <span class="input-group-text bg-transparent border-0 pr-2 pr-sm-3" id="basic-addon1"></span>
                    </div>
                    <input type="search" class="form-control" placeholder="Search Dashboard" aria-label="Search Dashboard">
                    <div class="drop-down animated flipInX d-md-none">
                        <form action="#">
                            <input type="text" class="form-control" placeholder="Search">
                        </form>
                    </div>
            </div>
            <?php } ?> -->
            <div class="header-right">
                <ul class="clearfix">
                    <?php if(Yii::$app->user->isGuest){?>
                    <li class="icons dropdown">
                        <a href="<?=Url::to('/yiiajie/Forum/frontend/web/site/login'); ?>">
                            <span class="px-4 ml-6 badge-pill gradient-1">LOGIN</span>
                        </a>
                        <a href="<?=Url::to('/yiiajie/Forum/frontend/web/site/signup'); ?>">
                            <span class="px-4 ml-5 badge-pill gradient-1">SIGNUP</span>
                        </a>
                    </li>
                    <?php } else { ?>
                        <li class="icons dropdown">
                        <a href="javascript:void(0)" data-toggle="dropdown">
                            <i class="mdi mdi-bell-outline"></i>
                            <span class="badge badge-pill gradient-1">!</span>
                        </a>
                        <div class="drop-down animated fadeIn dropdown-menu">
                            <div class="dropdown-content-heading d-flex justify-content-between">
                                <?php if((Yii::$app->params['notif'])->getModels()==null){ ?>
                                <span class="">Empty</span>  
                                <?php } ?>
                                <!--<a href="javascript:void()" class="d-inline-block">
                                    <span class="badge badge-pill gradient-1">3</span>
                                </a>-->
                            </div>
                            <div class="dropdown-content-body">
                                <ul>
                                    <?php
                                    $data=(Yii::$app->params['notif'])->getModels();
                                  
                                    foreach($data as $notif){
                                    ?>
                                    <li class="notification-unread">
                                        <a href="<?php echo Url::to(['comments/index','idPost' => $notif['idPosting']]); ?>">
                                            <img class="float-left mr-3 avatar-img" src="<?php echo Yii::$app->request->baseUrl ?>/images/avatar/<?php echo $notif['fotoUser']?>" alt="">
                                            <div class="notification-content">
                                                <div class="notification-heading"><?php echo $notif['fullname'] ?></div>
                                                
                                                <?php if($notif['love']==1){?>
                                                <div class="notification-text">liked your Post</div>
                                                <?php } 
                                                else if ($notif['dislike']==1){?>
                                                <div class="notification-text">Dislike your Post</div>
                                                <?php } ?>
                                            </div>
                                        </a>
                                    </li>
                                    <?php } ?>
                                </ul>

                            </div>
                        </div>
                    </li>
                    
                    
                    <li class="icons dropdown">
                        <div class="user-img c-pointer position-relative"   data-toggle="dropdown">
                            <span class="activity active"></span>
                            <img src="<?php echo Yii::$app->request->baseUrl ?>/images/avatar/<?php echo Yii::$app->user->identity->fotoUser; ?>" height="40" width="40" alt="">
                        </div>
                        <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                            <div class="dropdown-content-body">
                                <ul>
                                    <li>
                                        <a href="<?php echo Url::to(['user/view','id' => Yii::$app->user->getID()]); ?>"><i class="icon-user"></i> <span>Profile</span></a>
                                    </li>
                                    

                                    <hr class="my-2">
                                    <li>
                                        <a href="<?php echo Url::to(['user/updatepassword','id' => Yii::$app->user->getID()]); ?>"><i class="icon-lock"></i> <span>Edit Password</span></a>
                                    </li>
                                    
                                    <li>
                                        <a href="/yiiajie/Forum/frontend/web/site/logout"><i class="icon-key"></i> <span>Logout</span></a></li>
                                    
                                </ul>
                            </div>
                        </div>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
    <!--**********************************
        Header end ti-comment-alt
    ***********************************-->

    <!--**********************************
        Sidebar start
    ***********************************-->
    <?php if(!Yii::$app->user->isGuest){?>
    <div class="nk-sidebar">           
        <div class="nk-nav-scroll">
            <ul class="metismenu justify-content-center" id="menu">
                
                <li class="nav-label">Dashboard</li>
                <li>
                    <a href="http://localhost/yiiajie/Forum/frontend/web/">
                        <i class="icon-home menu-icon"></i><span class="nav-text">Dashboard</span>
                    </a>
                    
                </li>
                <li>
                    <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="icon-grid menu-icon"></i> <span class="nav-text">Category</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="<?php echo Url::to(['posting/index', 'idCategory'=>1 ]);?>">Mathematics</a></li>
                        <li><a href="<?php echo Url::to(['posting/index', 'idCategory'=>2 ]);?>">Kimia</a></li>
                        <li><a href="<?php echo Url::to(['posting/index', 'idCategory'=>3 ]);?>">Java</a></li>
                        <li><a href="<?php echo Url::to(['posting/index', 'idCategory'=>4 ]);?>">PHP</a></li>
                        <li><a href="<?php echo Url::to(['posting/index', 'idCategory'=>5 ]);?>">C#</a></li>
                        <li><a href="<?php echo Url::to(['posting/index', 'idCategory'=>6 ]);?>">Android</a></li>
                        <li><a href="<?php echo Url::to(['posting/index', 'idCategory'=>7 ]);?>">English</a></li>
                        <li><a href="<?php echo Url::to(['posting/index', 'idCategory'=>8 ]);?>">Physics</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="http://localhost/yiiajie/Forum/frontend/web/user" aria-expanded="false">
                        <i class="icon-user menu-icon"></i> <span class="nav-text">Top Members</span>
                    </a>
                </li>
                <li>
                    <a class="has-arrow" href="#" >
                        <i class="icon-phone menu-icon"></i> <span class="nav-text">Helps</span>
                    </a>
                </li>
                
            </ul>
        </div>
 
    </div>
    <?php } ?>
        <!--**********************************
            Sidebar end
        ***********************************-->
    <div class="container">
        
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>

                    
    
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
