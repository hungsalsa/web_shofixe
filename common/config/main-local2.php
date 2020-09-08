<?php
return [
    'components' => [
        'db1' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=nhotxin_quanly_1',
            'username' => 'nhotxin_quanlymt',
            'password' => 'ACuT!%2+){e4fq@[f&',
            'charset' => 'utf8',
        ],
        'db2' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=nhotxin_quanly_2',
            'username' => 'nhotxin_quanlymt',
            'password' => 'ACuT!%2+){e4fq@[f&',
            'charset' => 'utf8',
        ],
        // 'db3' => [
        //     'class' => 'yii\db\Connection',
        //     'dsn' => 'mysql:host=localhost;dbname=qlmtt_hh',
        //     'username' => 'root',
        //     'password' => '',
        //     'charset' => 'utf8',
        // ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        
    ],
];
