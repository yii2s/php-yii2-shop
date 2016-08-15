<?php

namespace common\hybrid;


use common\models\Goods;
use common\models\GoodsPhoto;

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
        $goods->model_id = (int)$args['model_id'];
        $goods->sell_price = $args['sell_price'];
        $goods->market_price = $args['market_price'];
        $goods->cost_price = $args['cost_price'];
        $goods->up_time = $args['up_time'];
        $goods->down_time = $args['down_time'];
        $goods->create_time = $args['create_time'] ?: date('Y-m-d H:i:s', time());
        $goods->store_nums = (int)$args['store_nums'] ?: 0;
        $goods->img = $args['img'];
        $goods->ad_img = $args['ad_img'];
        $goods->is_del = $args['is_del'];
        $goods->content = $args['content'];
        $goods->keywords = $args['keywords'];
        $goods->description = $args['description'];
        $goods->weight = $args['weight'] ?: 0.00;
        $goods->point = (int)$args['point'] ?: 0;
        $goods->unit = $args['unit'];
        $goods->brand_id = (int)$args['brand_id'] ?: 0;
        $goods->visit = (int)$args['visit'] ?: 0;
        $goods->favorite = (int)$args['favorite'] ?: 0;
        $goods->sort = (int)$args['sort'];
        $goods->spec_array = $args['spec_array'];
        $goods->exp = (int)$args['exp'] ?: 0;
        $goods->comments = (int)$args['comments'] ?: 0;
        $goods->sale = (int)$args['sale'] ?: 0;
        $goods->grade = (int)$args['grade'] ?: 0;
        $goods->seller_id = $args['seller_id'];
        $goods->is_share = (int)$args['is_share'] ?: 0;

        return $goods->save() ? $goods->id : 0;
    }

    /**
     * @brief 保存商品图集
     * @param string $id 图片md5值
     * @param string $img 图片路径
     * @return int
     * @author wuzhc 2016-08-11
     */
    public function saveGoodsPhoto($id, $img)
    {
        if ($id) {
            $goodsPhoto = GoodsPhoto::findOne($id);
        }
        if (!isset($goodsPhoto)) {
            $goodsPhoto = new GoodsPhoto();
        }
        $goodsPhoto->id = $id;
        $goodsPhoto->img = $img;
        return $goodsPhoto->save() ? $goodsPhoto->id : 0;
    }

}