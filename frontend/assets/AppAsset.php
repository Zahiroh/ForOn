<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        
        'plugins/pg-calendar/css/pignose.calendar.min.css',
        'plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css',
        'plugins/chartist/css/chartist.min.css',
        'css/style.css',
        //'css/style.css.map',
        //'css/site.css',
    ];
    public $js = [
        
        'plugins/common/common.min.js',
        'js/custom.min.js',
        'js/settings.js',
        'js/gleek.js',
        //'css/style.css.map',
        
        'js/styleSwitcher.js',
        'plugins/chart.js/Chart.bundle.min.js',
        'plugins/circle-progress/circle-progress.min.js',
        
        'plugins/d3v3/index.js',
        'plugins/topojson/topojson.min.js',
        'plugins/datamaps/datamaps.world.min.js',
        
        'plugins/raphael/raphael.min.js',
        'plugins/morris/morris.min.js',
        'plugins/moment/moment.min.js',
        'plugins/pg-calendar/js/pignose.calendar.min.js',
        
        'plugins/chartist/js/chartist.min.js',
        'plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js',
        'js/dashboard/dashboard-1.js',
    ];
    public $depends = [
        //'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
