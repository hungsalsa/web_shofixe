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
        'quantri' => [
            'class' => 'backend\modules\quantri\Quantri',
        ],
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
                  // 'defaultRoute' => '/quantri/index',
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest'],
        ],
        
    ],
    'params' => $params,
];
