<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class ProductAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
       'plugin/css/bootstrap.min.css',
        'plugin/css/animate.min.css',
        'plugin/css/light-bootstrap-dashboard.css?v=1.4.0',
        'plugin/css/demo.css',
        'http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css',
        'http://fonts.googleapis.com/css?family=Roboto:400,700,300',
        'plugin/css/pe-icon-7-stroke.css',
        'css/jquery-ui.min.css',

        'https://use.fontawesome.com/releases/v5.3.1/css/all.css',
        'css/my.css'
    ];
    public $js = [
        'plugin/js/jquery.3.2.1.min.js',
        'plugin/js/bootstrap.min.js',
        'plugin/js/chartist.min.js',
        'plugin/js/bootstrap-notify.js',
        // 'https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE',
        'plugin/js/light-bootstrap-dashboard.js?v=1.4.0',
        'plugin/js/demo.js',
        'js/jquery-ui.min.js',
        'tinymce/tinymce.min.js',
        'https://use.fontawesome.com/releases/v5.3.1/js/all.js',
        'js/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
