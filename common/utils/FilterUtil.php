<?php
/**
 * Created by PhpStorm.
 * User: wuzhc
 * Date: 2016/8/29
 * Time: 11:14
 */

namespace common\utils;


class FilterUtil
{
    /**
     * @brief 是否没有值，与empty()函数区别在于，当值为0时，这里会返回false
     * @param string $value
     * @return bool
     */
    public static function isEmptyValue($value = '')
    {
        return $value === '' || $value === null || $value === false;
    }

}