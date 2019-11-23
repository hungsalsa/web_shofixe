<?php
use yii\web\Request;
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
        'auth' => [
            'class' => 'backend\modules\auth\Module',
        ],
        'setting' => [
            'class' => 'backend\modules\setting\setting',
        ],
        'quanlytin' => [
            'class' => 'backend\modules\quanlytin\Quanly',
        ],
    ],
    
    'components' => [
        
        'request' => [
            'csrfParam' => '_csrf-backend',
            'enableCsrfValidation' => false,
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        /*'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
            'authTimeout' => 3600,// 60*60*24, // Log out after 24 
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],*/
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
                '<controller:[\w-]+>/<action:\w+>/<id:\d+>/<currentStatus:\d+>/<field:\w+>' => '<controller>/<action>',
                '<controller:[\w-]+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',

                // 'pattern'=>'<action>', 'route'=>'controller/<action>',
                  'defaultRoute' => '/quanlytin/news',
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest'],
        ],
        
    ],
    'params' => $params,
    'defaultRoute' => 'quanlytin/news',
];
