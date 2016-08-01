<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) -
            // this is required by cookie validation
            'cookieValidationKey' => 'v7mBbyetv4ls7t8UIqQ2IBO60jY_wf_U',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=127.0.0.1;dbname=iwebshop',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        'frontUrl' => [
            'class' => 'yii\web\UrlManager',
            'scriptUrl' => '/myweb2/index.php',   //���������֮����ܹ���������
            'showScriptName' => true,
            'enablePrettyUrl' => false,
        ],
        'urlManager' => [
            'rules' => [
                'posts' => 'post/index',
                'post/<id:\d+>' => 'post/view',
                '<controller:(post|comment)>/<id:\d+>/<action:(create|update|delete)>' => '<controller>/<action>',
                'DELETE <controller:\w+>/<id:\d+>' => '<controller>/delete',
                'http://<user:\w+>.digpage.com/<lang:\w+>/profile' => 'user/profile',
            ]
        ],

    ],
];
