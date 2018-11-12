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
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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

        'request'=>array(
            'baseUrl'=>$baseUrl
        ),
        
        'urlManager' => [
            'baseUrl'=>$baseUrl,
            'showScriptName' => false,
            'enablePrettyUrl' => true,
            // 'suffix' => '/',
            // 'enableStrictParsing' => false,
            'rules' => [
                // '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                'gio-hang/addcart/<id:\d+>/<num:\d+>' => 'gio-hang/addcart',
                'gio-hang/delcart/<id:\d+>' => 'gio-hang/delcart',
                'gio-hang/updatecart/<id:\d+>/<num:\d+>' => 'gio-hang/updatecart',
                // '<controller:\w+>/<action:\w+>/<slug:\w+>' => '<controller>/<action>',
                // '<controller:\w+>/<action:\w+>/<id:\d+>/<soluong:\d+>' => '<controller>/<action>/',
                // 'product/<id:\d+>/<slug>' => 'product/view',
                'tin-tuc/<slug>.html' => 'tin-tuc/view',
                'tin-tuc/<slug>' => 'tin-tuc/list',
                '<slug>.html' => 'product/view',
                'san-pham/<slug>' => 'product/danhsach',
                // 'san-pham/<slug>/trang-<page:\d+>' => 'product/danhsach',




                // 'chi-tiet/<slug>' => 'tin-tuc/view',
                // 'san-pham/<slug>'=>'product/listpro/<id:\d+>',
                // 'tin-tuc/<slug>' => 'categories/danhsach',
                // '<slug>'=>'<id:\d+>/<slug>',
                // ':slug.html'=>'product/view'
                // '<controller:\w+>/<slug:\d+>' => '<controller>/view',
                // 'product/<slug:\w+>' => 'product/view',
              //   // '<controller:\w+>/<slug:\w+>' => '<controller>/view',
            
              // '<action:\w+>/<slug:\d+>' => '<controller>/<action>',
              '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
              '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                
                // 'product'=>'product/index',
                // 'danh'=>'product/listpro',
                // '<slug:[a-zA-Z0-9]+>-<id:\d+>'=>'product/view',
                // '<slug>' => 'product/view',
                // 'product/view/<id:\d+>' => 'product/view', 
                // 'product/<slug>' => 'product/slug',
                // '<:slug>-<id:\d+>' => 'product/view',
                'defaultRoute' => '/site/index',
            ],
        ],
        
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
