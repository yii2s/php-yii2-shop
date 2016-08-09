<?php

namespace common\service;


use common\config\Conf;
use common\hybrid\GoodsHybrid;
use Faker\Provider\DateTime;

class GoodsService extends AbstractService
{

    /**
     * Returns the static model.
     * @param string $className Service class name.
     * @return GoodsService the static model class
     */
    public static function factory($className=__CLASS__)
    {
        return parent::factory($className);
    }

    public function save($args)
    {
        if ($args['is_del'] == Conf::DOWN_GOODS)
        {
            $args['up_time'] = DateTime::date('Y-m-d H:i:s');
        }
        elseif ($args['is_del'] == Conf::UP_GOODS)
        {
            $args['down_time'] = DateTime::date('Y-m-d H:i:s');
        }

        $args['create_time'] = DateTime::date('Y-m-d H:i:s');

        //保存商品基本数据
        $goodsHybrid = new GoodsHybrid();
        $goodsID = $goodsHybrid->save($args);
        if (!$goodsID) {
            return false;
        }

        //保存商品图集




    }


}