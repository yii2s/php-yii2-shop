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
     * @since 2016-08-09
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

    /**
     * @brief 生成链接地址
     * @param string|array $params @see UrlManager->createUrl()
     * @return string
     * @since 2016-08-28
     */
    public function createUrl($params)
    {
        return Yii::$app->urlManager->createUrl($params);
    }

    /**
     * @brief 获取类名
     * @param $object
     * @return string
     */
    public function getShortName($object)
    {
        $object = new \ReflectionClass($object);
        return $object->getShortName();
    }

    /**
     * 获取url传参
     * @param string $name 字段名
     * @param null $default 默认值
     * @param null $filter 过滤器，只支持系统内置函数，多个时使用逗号隔开
     * @return array|mixed
     * @since 2016-10-11
     */
    public function getParam($name, $default = null, $filter = null)
    {
        $value = Yii::$app->request->get($name) ?: Yii::$app->request->post($name);
        if (empty($name) && $name !== 0) {
            return $default ?: $value;
        }

        if (!$filter || !is_string($filter)) {
            return $value;
        }

        $filterArr = explode(',', str_replace('，', ',', $filter));
        foreach ($filterArr as $f) {
            if (!function_exists($f)) {
                continue;
            }
            $value = $f($value);
        }
        return $value;
    }

}