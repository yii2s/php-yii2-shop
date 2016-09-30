<?php
/**
 * Created by PhpStorm.
 * User: wuzhc
 * Date: 2016/8/29
 * Time: 10:19
 */

namespace common\utils;



class DebugUtil
{
    /**
     * 打印数据 print
     * @param $data
     */
    public static function p($data)
    {
        echo '<pre>';
        if (is_object($data))
        {
            $object = new \ReflectionClass($data);
            print_r($object->getProperties());
        }
        elseif (is_array($data))
        {
            print_r($data);
        }
        else
        {
            echo $data;
        }
        echo '</pre>';

        exit;
    }

    /**
     * 打印类方法 print class methods
     * @param $class
     * @since 2016-09-29
     */
    public static function pcm($class)
    {
        static::p(get_class_methods($class));
    }

    /**
     * 打印类属性 print class vars
     * @param $class
     */
    public static function pcv($class)
    {
        static::p(get_class_vars(get_class($class)));
    }

    /**
     * 打印父类 print parent class
     * @param $class
     */
    public static function ppc($class)
    {
        static::p(get_parent_class(get_class($class)));
    }

    /**
     * 类的相关信息
     * @param $class
     */
    public static function export($class)
    {
        $object = new \ReflectionClass(get_class($class));
        \Reflection::export($object);
    }
}