<?php
use yii\web\Request;
$baseUrl = str_replace('/frontend/web','', (new Request)->getBaseUrl());
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log','MyGlobalClass'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'quantri' => [
            'class' => 'frontend\modules\quantri\quantri',
        ],
        'setting' => [
            'class' => 'frontend\modules\setting\setting',
        ],
    ],
    'components' => [
        'MyGlobalClass'=>[
            'class'=>'app\components\MyGlobalClass'
        ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        // 'session' => [
        //     // this is the name of the session cookie used for login on the frontend
        //     'name' => 'advanced-frontend',
        // ],
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

        'request'=>array(
            'baseUrl'=>$baseUrl
        ),
        
        'urlManager' => [
            'baseUrl'=>$baseUrl,
            'showScriptName' => false,
            'enablePrettyUrl' => true,
            // 'suffix' => '.html',
            // 'suffix' => '/',
            // 'enableStrictParsing' => false,
            'rules' => [
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>/<slug:\w+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>/<slug:\w+>' => '<controller>/<action>',
                // '<controller:\w+>/<action:\w+>/<key_search:\w+>' => '<controller>/<action>',
                // '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                '<slug:[a-zA-Z0-9_ -]+>.html' => 'detail/index',
                // '<slug_cate:[a-zA-Z0-9_ -]+>' => 'category/index',
                // '<slug_cate:[a-zA-Z0-9_ -]+>/trang-<trang:\d+>' => 'category/index',
                // 'search/<key_search:[\w\+]+>' => 'search/index',
                // 'search' => 'search/index',

                // 'search/<key_search:[a-z0-9-]+>/trang-<page:\d+>' => 'search/index',
                // 'tim-kiem' => 'search/view',
                // 'tim-kiem/<keySearch:\w+>' => 'search/view',

                'albums' => 'albums/index',

                '<slug:[a-z0-9-]+>/trang-<page:\d+>' => 'category/index',
                '<slug:[a-z0-9-]+>' => 'category/index',


                // '<slug:[a-z0-9-]+>/trang-<page:\d+>' => 'danh-sach/index',
                // [
                //     'pattern' => 'tim-kiem',
                //     'route' => 'search/view',
                //     'suffix' => '.htm',
                // ],
                // 'tim-kiem/keySearch-<keySearch:\d+>' => 'search/view',
                // [
                //     'pattern' => 'tim-kiem/<keySearch:[a-z0-9-]+>',
                //     'route' => 'search/view',
                //     // 'suffix' => '.htm',
                // ],
                
                // '<controller:\w+>/key-<keySearch:\d+>' => 'search/view',
                // '<controller:\w+>' => 'search/view',


                // 'timkiem/<key_search:\w+]+>' =>'search/view',
                // 'timkiem' =>'site/view',

                [
                     'pattern' => 'tim-kiem/<key_search:[w+]+>',
                    'route' => 'search/view',
                ],

                
                'videos/<slug:[a-z0-9_ -]+>.html' =>'videos/view',
                // 'videos/danh-sach/trang-<page:\d+>' => 'category/index',
                // 'videos/<slug:[a-z0-9_ -]+>-<id:\d+>/trang-<page:\d+>' => 'category/category',
                'videos/<slug:[a-z0-9_ -]+>-<id:\d+>' =>'videos/category',
                'videos/danh-sach' =>'videos/index',

                
                // [
                //     'pattern' => 'search/key-<key_search:[\w\+]+>', 
                //     'route' => 'search/index', 
                //     // 'suffix' => '.html'
                // ],


                
                // '<alias:tim-kiem>/<slug:\w+>' => 'site/<alias>',
                'defaultRoute' => '/site/index',
            ],
        ],

        'formatter' => [
            'thousandSeparator' => '.',
            'defaultTimeZone' => 'Asia/Ho_Chi_Minh',
            // 'currencyCode' => 'VNĐ',
        ],
        // 'assetManager' => [
        //     'bundles' => [
        //         'yii\web\JqueryAsset' => [
        //             'js'=>[]
        //         ],
        //         'yii\bootstrap\BootstrapPluginAsset' => [
        //             'js'=>[]
        //         ],
        //         'yii\bootstrap\BootstrapAsset' => [
        //             'css' => [],
        //         ],

        //     ],
        // ],
        
    ],
    
    'params' => $params,

    // 'container' => [
    //     'definitions' => [
    //         'yii\widgets\LinkPager' => [
    //             'firstPageLabel' => 'First',
    //             'lastPageLabel'  => 'Last'
    //         ]
    //     ]
    // ],
];
