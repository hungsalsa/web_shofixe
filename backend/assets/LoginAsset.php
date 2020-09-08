<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class LoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
       'bootstrap/dist/css/bootstrap.min.css',
       'css/animate.css',
       'css/style.css',
       'css/colors/blue.css',
    ];
    public $js = [
        // 'plugins/bower_components/jquery/dist/jquery.min.js',
        'bootstrap/dist/js/bootstrap.min.js',
        'plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js',
        // 'js/jquery.slimscroll.js',
        // 'js/waves.js',
        // 'js/custom.min.js',
        'plugins/bower_components/styleswitcher/jQuery.style.switcher.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
