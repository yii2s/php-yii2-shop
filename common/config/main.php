<?php

/** 是否开启缓存 */
define('CACHE_ON', false);

return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        /*'request' => [
            // !!! insert a secret key in the following (if it is empty) -
            // this is required by cookie validation
            'cookieValidationKey' => 'v7mBbyetv4ls7t8UIqQ2IBO60jY_wf_U',
        ],*/
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=shop2',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'tablePrefix' => 'zc_',
        ],

        /*'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=23.83.240.107;dbname=shop',
            'username' => 'root',
            'password' => 'wuzhc',
            'charset' => 'utf8',
            'tablePrefix' => 'zc_',
        ],*/

        'frontUrl' => [
            'class' => 'yii\web\UrlManager',
            'scriptUrl' => '/myweb2/index.php',   //���������֮����ܹ���������
            'showScriptName' => true,
            'enablePrettyUrl' => false,
        ],
        'urlManager' => [
            /*'rules' => [
                'posts' => 'post/index',
                'post/<id:\d+>' => 'post/view',
                '<controller:(post|comment)>/<id:\d+>/<action:(create|update|delete)>' => '<controller>/<action>',
                'DELETE <controller:\w+>/<id:\d+>' => '<controller>/delete',
                'http://<user:\w+>.digpage.com/<lang:\w+>/profile' => 'user/profile',
            ]*/
        ],
        'sphinx' => [
            'class' => 'yii\sphinx\Connection',
            'dsn' => 'mysql:host=23.83.240.107;port=9306;',
            'username' => 'root',
            'password' => 'wuzhc2580',
        ],
        'request' => [
            'enableCookieValidation' => true,
            'enableCsrfValidation' => true,
            'cookieValidationKey' => 'sfsfdsfsdf',
        ],
    ],
];
