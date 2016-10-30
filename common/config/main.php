<?php

/** 是否开启缓存 */
define('CACHE_ON', false);
/** 是否开启mongo */
define('MONGO_ON', false);

define('MONGO_HOST', '23.83.240.107');
define('MONGO_PORT', '27017');
define('MONGO_DB', 'zcshop_1');

define('SPHINX_HOST', '127.0.0.1');
define('SPHINX_PORT', '9312');

return [
    'timeZone' => 'Asia/Shanghai',
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
            'dsn' => 'mysql:host=localhost;dbname=shop',
            'username' => 'root',
            'password' => 'wuzhc2580',
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
        /*'request' => [
            'enableCookieValidation' => true,
            'enableCsrfValidation' => true,
            'cookieValidationKey' => 'sfsfdsfsdf',
        ],*/
        'mongo' => [
            'class' => 'common\components\CMongo',
            'mongoDB' => MONGO_DB,
            'mongoPort' => MONGO_PORT,
            'mongoHost' => MONGO_HOST,
        ],
        'member' => [
            'class' => 'common\components\CMember',
            'identityClass' => 'common\models\Member', // User must implement the IdentityInterface
            'enableAutoLogin' => true,
              // 'loginUrl' => ['user/login'],
              // ...
        ],
        'sphinx' => [
            'class' => 'common\components\CSphinx',
            'port' => SPHINX_PORT,
            'host' => SPHINX_HOST,
        ],
    ],
];
