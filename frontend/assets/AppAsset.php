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
        // 'css/bootstrap.min.css',
        // 'lib/custom-slider/css/nivo-slider.css',
        // 'lib/custom-slider/css/preview.css',
        // 'css/font-awesome.min.css',
        // 'css/material-design-iconic-font.css',
        // 'css/material-design-iconic-font.min.css',
        // 'css/owl.carousel.css',
        // 'css/jquery-ui.css',
        // 'css/meanmenu.min.css',
        // 'css/animate.css',
        // 'css/animate-heading.css',
        // 'css/reset.css',
        // 'css/jquery.mb.YTPlayer.css',
        // 'css/style.css',
        // 'css/responsive.css',
    ];
    public $js = [
        // 'js/vendor/modernizr-2.8.3.min.js',
        // 'js/vendor/jquery-1.12.4.min.js',
        // 'js/bootstrap.min.js',
        // 'js/jquery.meanmenu.js',
        // 'js/wow.min.js',
        // 'js/owl.carousel.min.js',
        // 'js/jquery.countdown.min.js',
        // 'js/jquery.mb.YTPlayer.js',
        // 'js/jquery.ajaxchimp.min.js',
        // 'js/jquery-price-slider.js',
        // 'js/jquery.elevateZoom-3.0.8.min.js',
        // 'js/jquery.scrollUp.min.js',
        // 'js/plugins.js',
        // 'lib/custom-slider/js/jquery.nivo.slider.js',
        // 'lib/custom-slider/home.js',
        // 'js/jquery.textillate.js',
        // 'js/jquery.lettering.js',
        // 'js/animate-heading.js',
        // 'js/ajax-mail.js',
        // 'js/main.js',
        // 'vender/my.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
