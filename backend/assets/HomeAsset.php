<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class HomeAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'bootstrap/dist/css/bootstrap.min.css',
        'plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css',
        'plugins/bower_components/toast-master/css/jquery.toast.css',
        'plugins/bower_components/morrisjs/morris.css',
        'plugins/bower_components/chartist-js/dist/chartist.min.css',
        'plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css',
        'plugins/bower_components/calendar/dist/fullcalendar.css',
        'css/animate.css',
        'css/style.css',
        'css/colors/default.css',
    ];
    public $js = [
        'plugins/bower_components/jquery/dist/jquery.min.js',
        'bootstrap/dist/js/bootstrap.min.js',
        'plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js',
        'js/jquery.slimscroll.js',
        'js/waves.js',
        'plugins/bower_components/flot/excanvas.min.js',
        'js/custom.js',
        'plugins/bower_components/flot/jquery.flot.js',
        'plugins/bower_components/flot/jquery.flot.pie.js',
        'plugins/bower_components/flot/jquery.flot.time.js',
        'plugins/bower_components/flot.tooltip/js/jquery.flot.tooltip.min.js',
        'plugins/js/bootstrap-notify.min.js',
// 'js/1flot-data.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
