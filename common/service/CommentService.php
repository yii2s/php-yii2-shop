<?php

namespace common\service;


use common\hybrid\AbstractHybrid;
use Yii;

class CommentService extends AbstractService
{

    /**
     * Returns the static model.
     * @param string $className Service class name.
     * @return CommentService the static model class
     */
    public static function factory($className = __CLASS__)
    {
        return parent::factory($className);
    }

    /**
     * @brief 添加评论
     * @param $data
     * @return bool
     * @since 2016-09-01
     */
    public function addComment($data)
    {
        $data = [
            'goods_id' => 1,
            'order_no' => 1,
            'member_id' => 1,
            'buy_time' => 1,
            'comment_time' => 1,
            'contents' => 1,
            'point' => 1,
            'status' => 1,
            'seller_id' => 1,
        ];
        $hybrid = new AbstractHybrid();
        return $hybrid->save('\common\models\comment', $data) > 0 ? true : false;
    }

}