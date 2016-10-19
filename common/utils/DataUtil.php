<?php
/**
 * Created by PhpStorm.
 * User: wuzhc
 * Date: 2016/8/31
 * Time: 9:02
 */

namespace common\utils;


class DataUtil
{
    /**
     * 递归处理数据
     * @param callback|string $func 数据处理函数

     * @return array
     * @since 2016-10-16
     */
    public static function recursiveHandle($func, $datas)
    {
        $result = [];
        foreach ((array)$datas as $key => $data) {
            $result[$key] = is_array($data) ? self::recursiveHandle($func, $data) : call_user_func($func, $data);
        }
        return $result;
    }
}