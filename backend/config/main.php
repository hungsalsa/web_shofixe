<?php
use yii\web\Request;
// use yii\di\Instance;
$baseUrl = str_replace('/web', '', (new Request)->getBaseUrl());
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
        
    'modules' => [
        'quantri' => [
            'class' => 'backend\modules\quantri\Quantri',
        ],
        'auth' => [
            'class' => 'backend\modules\auth\Module',
        ],
        'chi' => [
            'class' => 'backend\modules\chi\chi',
        ],
        'doanhthu' => [
            'class' => 'backend\modules\doanhthu\doanhthu',
        ],
        'phieu' => [
            'class' => 'backend\modules\phieu\phieu',
        ],
        'common' => [
            'class' => 'backend\modules\common\common',
        ],
        'sanpham' => [
            'class' => 'backend\modules\sanpham\sanpham',
        ],
        'khachhang' => [
            'class' => 'backend\modules\khachhang\khachhang',
        ],
        'doanhthu' => [
            'class' => 'backend\modules\doanhthu\setting',
        ],
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
        // enter optional module parameters below - only if you need to  
        // use your own export download action or custom translation 
        // message source
        // 'downloadAction' => 'gridview/export/download',
        // 'i18n' => []
        ],
        'gii' => [
            'class' => 'yii\gii\Module',
            'allowedIPs' => ['127.0.0.1', '::1'],
            // 'password' => '123456'
        ],
        
    ],
    // 'language'=>'vi', 
    'components' => [
        'formatter' => [
            'decimalSeparator' => ',',
            'thousandSeparator' => '.',
       ],
        'request' => [
            'csrfParam' => '_csrf-backend',
            'enableCsrfValidation' => false,
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
            'authTimeout' => 1800,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'request'=>[
            'baseUrl'=>$baseUrl
        ],
        
        'urlManager' => [
            'baseUrl'=>$baseUrl,
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'nhanbankhoanchi' => 'chi/khoanchi/capnhatma',
                'nhanbandichvu' => 'khachhang/danhsachdichvu/nhanban',
                'suamasanpham' => 'sanpham/nhanban/suama',
                'dichvukhachhang' => 'khachhang/khachhangdichvu',
                  // 'defaultRoute' => '/quantri/index',
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest'],
            'db'=>'db1'
        ],
        // 'assetManager' => [
        //     'bundles' => [
        //         'yii\web\JqueryAsset' => [
        //             'js'=>[]
        //         ],
        //         'yii\bootstrap\BootstrapPluginAsset' => [
        //             'js'=>[]
        //         ],
        //     ],
        // ],

        
    ],
    'params' => $params,
];
