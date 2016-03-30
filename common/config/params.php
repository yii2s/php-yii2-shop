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
];
