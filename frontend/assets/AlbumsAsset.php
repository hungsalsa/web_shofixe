<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AlbumsAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css',
        'css/owl.carousel.css',
        'css/owl.theme.default.css',
        'css/style.css',
          
    ];
    public $js = [
        'https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js',
        'https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js',
        'js/owl.carousel.js',
        'js/album.js'
    ];
    public $depends = [
        // 'yii\web\YiiAsset',
        // 'yii\bootstrap\BootstrapAsset',
    ];
}
