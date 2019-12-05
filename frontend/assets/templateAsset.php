<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class templateAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        //'css/style.css',
        //'css/style.css.map',
        
    ];
    public $js = [
        //'js/dashboard/dashboard-1.js',
        //'js/plugins-init/custom.min.js',
        //'js/gleek.js',
        //'js/settings.js',
        //'js/styleSwicher.js'
        
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
