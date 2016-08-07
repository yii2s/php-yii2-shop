<?php

namespace common\hybrid;


use common\models\Goods;

class GoodsHybrid extends AbstractHybrid
{

    public $id;

    public function __construct($id = 0)
    {
        $this->id = $id;
    }

    /**
     * @brief 保存修改
     * @param $args
     * @return int
     * @author wuzhc 2016-08-07
     */
    public function save($args)
    {
        if ($args['id']) {
            $goods = Goods::findOne($args['id']);
        } else {
            $goods = new Goods();
        }

        $goods->name = $args['name'];
        $goods->goods_no = $args['goods_no'];
        $goods->model_id = $args['model_id'];
        $goods->sell_price = $args['sell_price'];
        $goods->market_price = $args['market_price'];
        $goods->cost_price = $args['cost_price'];
        $goods->up_time = $args['up_time'];
        $goods->down_time = $args['down_time'];
        $goods->create_time = $args['create_time'];
        $goods->store_nums = $args['store_nums'];
        $goods->img = $args['img'];
        $goods->ad_img = $args['ad_img'];
        $goods->is_del = $args['is_del'];
        $goods->content = $args['content'];
        $goods->keywords = $args['keywords'];
        $goods->description = $args['description'];
        $goods->weight = $args['weight'];
        $goods->point = $args['point'];
        $goods->unit = $args['unit'];
        $goods->brand_id = $args['brand_id'];
        $goods->visit = $args['visit'];
        $goods->favorite = $args['favorite'];
        $goods->sort = $args['sort'];
        $goods->spec_array = $args['spec_array'];
        $goods->exp = $args['exp'];
        $goods->comments = $args['comments'];
        $goods->sale = $args['sale'];
        $goods->grade = $args['grade'];
        $goods->seller_id = $args['seller_id'];
        $goods->is_share = $args['is_share'];

        return $goods->save() ? $goods->id : 0;
    }

}