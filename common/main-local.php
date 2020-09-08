<?php
return [
    'components' => [
        'db1' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=xemay_quanlydemo',
            'username' => 'xemay_nx',
            'password' => '1Ya~\'rKp@bgeatxQ|n1"z@^=;r=S',
            'charset' => 'utf8',
        ],
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
