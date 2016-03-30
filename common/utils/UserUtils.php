<?php
namespace common\utils;

use Yii;

class UserUtils
{
    /**
     * 检测登录名类型
     * @param $loginName
     * @return bool
     */
    public static function checkLoginType($loginName)
    {
        if(!$loginName) {
            throw new \InvalidArgumentException('参数错误');
        }

        if(preg_match('#^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$#i',$loginName)) {
            return Yii::$app->params['emailLogin'];
        }
        if(preg_match('#^1[3|4|5|7]\\d{9}$#',$loginName)) {
            return Yii::$app->params['phoneLogin'];
        }
        return Yii::$app->params['generalLogin'];
    }
}