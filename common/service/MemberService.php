<?php

namespace common\service;

use common\config\Conf;
use common\hybrid\AbstractHybrid;
use common\models\Favorite;
use common\models\Member;
use Yii;

class MemberService extends AbstractService
{

    /**
     * Returns the static model.
     * @param string $className Service class name.
     * @return MemberService the static model class
     */
    public static function factory($className = __CLASS__)
    {
        return parent::factory($className);
    }

    public function detail($memberID)
    {
        return Member::findOne($memberID);
    }

    /**
     * @brief 会员收藏处理器
     * @param $goodsID
     * @param $memberID
     * @param int $action 处理动作 see Conf::ADD_FAVORITE, Conf::DEL_FAVORITE
     * @return bool
     */
    public function handleFavorite($goodsID, $memberID, $action)
    {
        $isAvailableAction = in_array($action, [Conf::ADD_FAVORITE, Conf::DEL_FAVORITE]);

        if ( !($goodsID && $memberID && $isAvailableAction) ) {
            return false;
        }

        $isFavoriteExist = $this->_isFavoriteExist($goodsID, $memberID);

        if ($action == Conf::ADD_FAVORITE) {
            if ($isFavoriteExist) {
                return true;
            } else {
                return $this->_addFavorite($goodsID, $memberID);
            }
        }

        if ($action == Conf::DEL_FAVORITE) {
            if ($isFavoriteExist) {
                $this->_delFavorite($goodsID, $memberID);
            } else {
                return true;
            }
        }
    }

    /**
     * @brief 添加收藏
     * @param $goodsID
     * @param $memberID
     * @return bool
     * @since 2016-09-01
     */
    private function _addFavorite($goodsID, $memberID)
    {
        $data = [
            'goods_id'    => $goodsID,
            'member_id'   => $memberID,
            'create_time' => date('Y-m-d H:i:s', time())
        ];

        $hybrid = new AbstractHybrid();
        return $hybrid->save('\common\models\favorite', $data) > 0 ? true : false;
    }

    /**
     * @brief 取消收藏
     * @param $goodsID
     * @param $memberID
     * @return bool
     * @since 2016-09-01
     */
    private function _delFavorite($goodsID, $memberID)
    {
        return Favorite::deleteAll(['goods_id'  => $goodsID, 'member_id' => $memberID,]) > 0 ? true : false;
    }

    /**
     * @brief 是否已存在收藏
     * @param $goodsID
     * @param $memberID
     * @return bool
     * @since 2016-09-01
     */
    private function _isFavoriteExist($goodsID, $memberID)
    {
        return Favorite::find()
            ->where(['goods_id'  => $goodsID, 'member_id' => $memberID])
            ->exists();
    }

}