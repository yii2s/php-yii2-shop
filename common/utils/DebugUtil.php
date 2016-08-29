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
    public static function format($data)
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
}