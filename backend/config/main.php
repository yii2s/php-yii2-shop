<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    //require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php')
    //require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'defaultRoute' => 'site/index', //默认控制器
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'permission' => [
            'class' => 'backend\module\permission\Module',
            //'layout' => 'left-menu',//yii2-admin的导航菜单
        ],
        'goods' => [
            'class' => 'backend\module\goods\GoodsModule',
        ],
        'admin' => [
            'class' => 'backend\module\admin\AdminModule'
        ],
    ],
    'components' => [
       /* 'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app'
                ],
            ],
        ],*/
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['site/login'], //设置未登录是的跳转地址
        ],
        /*'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],*/
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'assetManager' => [
            'basePath' => '@webroot/backend/web/assets',
            'baseUrl' => '@web/backend/web/assets'
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // 使用数据库管理配置文件
        ],
        'as access' => [
            'class' => 'backend\module\permission\components\AccessControl',
            'allowActions' => [
                //'site/*',//允许访问的节点，可自行添加
                //'admin/*',//允许所有人访问admin节点及其子节点
            ]
        ],
    ],
    'params' => $params,
];
