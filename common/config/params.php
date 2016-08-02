<?php
//Yii::$app->params['paramsName']
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
    'applicationID' => 1, //默认应用ID，如果有其他扩展应用，请在其他子配置文件重配置

    'generalLogin' => 1, //常规登录
    'emailLogin'   => 2, //邮箱登录
    'phoneLogin'   => 3, //手机登录

    //文件后缀
    'fileExt' => [
        'doc' => 1,
        'docx' => 1,
        'xls' => 2,
        'xlsx' => 2,
        'ppt' => 3,
        'pptx' => 3,
        'pdf' => 4,
        'txt' => 5,

        'gif' => 6,
        'jpeg' => 7,
        'png' => 8,
        'jpg' => 9,
        'bmp' => 10,

        'avi' => 11,
        'rmvb' => 12,
        '3gp' => 13,
        'flv' => 14,
        'wmv' => 15,
        'mp4' => 16,
        'mpeg' => 17,

        'zip' => 18,
        'rar' => 19,
        'tar' => 20,
        'iso' => 21,

        'swf' => 22,
        'fla' => 23,

        'mp3' => 24,
        'ogg' => 25,
        'wave' => 26,
        'wma' => 27,
        'wav' => 28 ,
    ],

];
