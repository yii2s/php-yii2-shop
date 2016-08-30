<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/30
 * Time: 16:49
 */

namespace common\service;


class SystemService extends AbstractService
{
    /**
     * Returns the static model.
     * @param string $className Service class name.
     * @return SystemService the static model class
     */
    public static function factory($className = __CLASS__)
    {
        return parent::factory($className);
    }

    public function statGoods($year, $month)
    {
        $sql1 = "SELECT DATE_FORMAT(create_time,'%Y-%m-%d') as time , count(*) as count FROM zc_goods GROUP BY time ";
        $sql2 = "SELECT count(distinct id),dayofmonth(create_time) as newtime FROM `zc_goods` where create_time between '2016-08-13' and '2016-09-13' group by newtime";
    }
}