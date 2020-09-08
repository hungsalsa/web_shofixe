<?php
return [
    'components' => [
        'db1' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=xemay_quanly',
            'username' => 'xemay_hungsalsa',
            'password' => '%yA%GS:nwxw@|o=1|C9Q',
            'charset' => 'utf8',
        ],
        'db2' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=xemay_quanly2',
            'username' => 'xemay_qly2',
            'password' => '4j0wDy8NO3u"PIgNXJ"3K+',
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
