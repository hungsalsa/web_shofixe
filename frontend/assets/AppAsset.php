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
        'vender/bootstrap/css/bootstrap.min.css',
        'vender/font-awesome/css/all.min.css',
        'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',
        'vender/css/global.css',  
        'vender/css/mobile.css',   
    ];
    public $js = [
        'vender/js/jquery-3.3.1.min.js',
        'vender/bootstrap/js/bootstrap.min.js',
        'vender/js/lazyload.js',
        'vender/js/custom.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
