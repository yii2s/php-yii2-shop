<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/30
 * Time: 16:49
 */

namespace common\service;


use common\models\Goods;

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

    /**
     * @brief 统计
     *
     * $sql1 = "SELECT DATE_FORMAT(create_time,'%Y-%m-%d') as time , count(*) as count FROM zc_goods GROUP BY time ";
     * $sql2 = "SELECT count(distinct id),dayofmonth(create_time) as newtime FROM `zc_goods` where create_time between '2016-08-13' and '2016-09-13' group by newtime";
     *
     * @param $year
     * @param $month
     *
     * 参数说明：
     * $year与$month将统计当前$month月份的每一天的数据量
     * $year将统计当前$year年份每一个月的数据量
     * 不传递参数时，将统计每一个年份的数据量
     *
     * @return array
     * <pre>
     * [
     *      ['num' => '数量', 'time' => '年|月|日'],
     *      ['num' => '数量', 'time' => '年|月|日'],
     * ]
     * </pre>
     */
    public function statGoods($year = null, $month = null)
    {
        $goods = Goods::find();
        $startTime = $endTime = null;

        if ($year && $month)
        {
            $time = strtotime(sprintf('%s-%s-01', $year, $month));
            $startTime = date('Y-m-d H:i:s', $time);
            $endTime = date('Y-m-d H:i:s', strtotime('+1 month', $time));
            $select = [
                'count(distinct id) as num',
                'dayofmonth(create_time) as time'
            ];
        }
        elseif ($year)
        {
            $time = strtotime(sprintf('%s-01', $year));
            $startTime = date('Y-m-d H:i:s', $time);
            $endTime = date('Y-m-d H:i:s', strtotime('+1 year', $time));
            $select = [
                'count(distinct id) as num',
                'month(create_time) as time'
            ];
        }
        else
        {
            $select = [
                'count(distinct id) as num',
                'DATE_FORMAT(create_time, "%Y") as time'
            ];
        }

        //统计时间范围
        if ($startTime && $endTime) {
            $goods->andFilterWhere(['between', 'create_time', $startTime, $endTime]);
        }

        return $goods->select($select)->groupBy('time')->asArray()->all();
    }

}