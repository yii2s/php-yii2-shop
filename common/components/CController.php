<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/9
 * Time: 23:24
 */

namespace common\components;


use Yii;
use yii\web\Controller;

class CController extends Controller
{

    /**
     * @brief 检测ajax请求
     * @param bool $stop 是否停止程序运行
     * @return bool
     * @author wuzhc 2016-08-09
     */
    public function checkAjaxRequest($stop = true)
    {
        if (!Yii::$app->request->isAjax) {
            $stop && Yii::$app->end('Invalid Request');
            return false;
        } else {
            return true;
        }
    }

}