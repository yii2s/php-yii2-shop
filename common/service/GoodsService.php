<?php

namespace common\service;


use common\models\AttrValue;
use common\models\Category;
use common\models\Goods;
use common\models\GoodsAttribute;
use common\models\GoodsAttrValMap;
use common\models\GoodsExtAttr;
use common\models\GoodsImage;
use common\models\GoodsPhoto;
use common\models\GoodsPhotoRelation;
use common\utils\FileUtil;
use common\utils\FilterUtil;
use common\utils\ImageUtil;
use common\utils\StringUtil;
use Yii;
use common\config\Conf;
use common\hybrid\AbstractHybrid;
use common\hybrid\GoodsHybrid;
use common\models\CommentGoods;
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

    /**
     * @brief 保存商品
     * @param $args
     * @return bool
     * @author wuzhc 2016-08-13
     */
    public function save($args)
    {
        //商品状态
        FilterUtil::isEmptyValue($args['is_del']) or $args['is_del'] = 0;
        if ($args['is_del'] == Conf::DOWN_GOODS) {
            $args['down_time'] = DateTime::date('Y-m-d H:i:s');
        } elseif ($args['is_del'] == Conf::UP_GOODS) {
            $args['up_time'] = DateTime::date('Y-m-d H:i:s');
        }

        $hybrid = new AbstractHybrid();
        $goodsHybrid = new GoodsHybrid();

        //用于列表页封面
        if ($args['img'] && FileUtil::isExists($args['img'])) {
            $args['ad_img'] = ImageUtil::thumbnail($args['img'], 220, 220);
        }

        //保存商品基本数据
        $goodsID = $goodsHybrid->save($args);
        if (!$goodsID) {
            return false;
        }

        //保存推荐
        if ($args['recommend']) {
            $this->_saveRecommend($goodsID, $args['recommend'], $hybrid);
        }

        //图集
        if ($args['images']) {
            $this->_saveImages($goodsID, $args['images'], $hybrid);
        }

        //保存系统属性值
        if ($args['sysAttr']) {
            $this->_saveSysAttr($goodsID, $args['sysAttr'], $hybrid);
        }

        //保存扩展属性
        if ($args['extAttr']) {
            $this->_saveExtAttr($goodsID, $args['extAttr'], $hybrid);
        }

        //保存商品规格
        if ($args['spec']) {
            $this->_saveSpec($goodsID, $args['spec'], $hybrid);
        }

        return $goodsID;
    }

    /**
     * @brief 保存推荐信息
     * @param $goodsID
     * @param array $recommend
     * @param AbstractHybrid $hybrid
     * @since 2016-08-29
     */
    private function _saveRecommend($goodsID, array $recommend, AbstractHybrid $hybrid)
    {
        CommentGoods::deleteAll(['goods_id' => $goodsID]);

        $values = [];
        foreach ((array)$recommend as $commendID) {
            $values[] = [intval($commendID), $goodsID];
        }

        $values and $hybrid->batchSave(CommentGoods::tableName(),['commend_id','goods_id'], $values);
    }

    /**
     * @brief 保存图集
     * @param $goodsID
     * @param array $images
     * @param AbstractHybrid $hybrid
     * @since 2016-08-29
     */
    private function _saveImages($goodsID, array $images, AbstractHybrid $hybrid)
    {
        GoodsImage::deleteAll(['gid' => $goodsID]);

        $values = [];
        foreach ((array)$images as $img) {
            if (!FileUtil::isExists($img)) {
                continue;
            }

            //生成缩略图
            $thumbStandards = Yii::$app->params['thumbStandards'];
            foreach ($thumbStandards as $size) {
                ImageUtil::thumbnail($img, $size[0], $size[1]);
            }

            $values[] = [$goodsID, $img];
        }

        $values and $hybrid->batchSave(GoodsImage::tableName(), ['gid', 'img'], $values);
    }

    /**
     * @brief 保存系统属性
     * @param $goodsID
     * @param array $attr
     * @param AbstractHybrid $hybrid
     * @since 2016-08-29
     */
    private function _saveSysAttr($goodsID, array $attr, AbstractHybrid $hybrid)
    {
        GoodsAttrValMap::deleteAll(['gid' => $goodsID]);

        $values = [];
        foreach ((array)$attr as $avid) {
            list($aid, $vid) = explode('-', $avid);
            $values[] = [$goodsID, intval($aid), intval($vid)];
        }

        $values and $hybrid->batchSave(GoodsAttrValMap::tableName(), ['gid', 'aid', 'vid'], $values);
    }

    /**
     * @brief 保存扩展属性
     * @param int $goodsID 商品ID
     * @param array $attr 扩展属性
     * @param AbstractHybrid $hybrid
     * @param int $uid 用户ID
     */
    private function _saveExtAttr($goodsID, array $attr, AbstractHybrid $hybrid, $uid = 0)
    {
        GoodsExtAttr::deleteAll(['gid' => $goodsID]);

        $values = [];
        foreach ((array)$attr as $a) {
            $temp = [];
            $temp['name'] = $a['name'];
            $temp['value'] = $a['value'];
            $temp['uid'] = $uid ?: Yii::$app->user->id;
            $temp['gid'] = $goodsID;
            $temp['create_time'] = date('Y-m-d H:i:s', time());
            $temp['status'] = intval($a['status']) ?: Conf::ENABLE;
            $values[] = $a;
        }

        $values and $hybrid->batchSave(GoodsExtAttr::tableName(), [
            'name', 'value', 'uid', 'gid', 'create_time', 'status'
        ], $values);
    }

    private function _saveSpec($goodsID, array $attr, AbstractHybrid $hybrid)
    {

    }

    /**
     * @brief 商品列表
     * @param $args
     * @return array|\yii\db\ActiveRecord[]
     * @author wuzhc 2016-08-14
     */
    public function getList($args)
    {
        $object = Goods::find()->from(Goods::tableName(). 'as t');
        if ($args['cid']) {
                $object->andFilterWhere(['t.cid' => $args['cid']]);
        }
        if ($args['select']) {
            $object->select((array)$args['select']);
        }
        if ($args['keyword']) {
            $object->Where(['like', 't.name', $args['keyword']]);
        }
        if (is_numeric($args['limit'])) {
            $object->limit($args['limit']);
        }
        if (is_numeric($args['offset'])) {
            $object->offset($args['offset']);
        }

        //属性值搜索
        if ($args['vid']) {
            $goodIDs = [];
            $first = 1;
            foreach ((array)$args['vid'] as $v) {
                $attrValMap = GoodsAttrValMap::find()
                    ->select(['gid'])
                    ->where(['vid' => $v])
                    ->asArray()
                    ->groupBy(['gid'])
                    ->all();
                $gids = array_map(function($a){return $a['gid'];}, $attrValMap);

                //如果没有找到对应的商品ID，说明没有对应属性值的商品，直接返回空数组
                if (!$gids) {
                    return array();
                }

                //第一次将值赋值goodIDs，之后循环都和之前的结果进行交集运算
                if ($first == 1) {
                    $goodIDs = $gids;
                } else {
                    $goodIDs = array_intersect($goodIDs, $gids);
                }

                $first++;
            }

            //如果没有找到对应的商品ID，说明没有对应属性值的商品，直接返回空数组
            if (!$goodIDs) {
                return array();
            }
            $object->andFilterWhere(['id' => $goodIDs]);
        }

        $args['order'] ? $object->orderBy((array)$args['order']) : $object->orderBy(['t.id' => SORT_DESC]);

        //return $object->createCommand()->getRawSql();
        return $object->asArray($args['asArray'])->groupBy('t.id')->all();
    }

    /**
     * @brief 推荐类商品
     * @param array $args
     * @return array|\yii\db\ActiveRecord[]
     * @author wuzhc 2016-08-16
     */
    public function getCommendGoods(array $args)
    {
        $limit = $args['limit'] ?: 10;
        $order = $args['order'] ?: ['t.id' => SORT_DESC];
        $select = $args['select'] ?: ['t.id','t.ad_img','t.name', 't.sell_price'];

        $object = Goods::find()->from(Goods::tableName(). 'as t');
        $object->leftJoin(CommentGoods::tableName() . 'as cg', 't.id = cg.goods_id');
        $object->andFilterWhere(['t.cid' => $args['cid']]);
        $object->andFilterWhere(['cg.commend_id' => $args['commend_id']]);
        $object->select($select);
        $object->asArray();
        $object->limit($limit);
        $object->orderBy($order);
        return $object->all();
    }

    /**
     * @brief 统计商品
     * @param $args
     * @return int|string
     * @author wuzhc 2016-08-14
     */
    public function countGoods($args)
    {
        $object = Goods::find()->from(Goods::tableName(). 'as t');
        if ($args['cid']) {
            $object->andFilterWhere(['t.cid' => $args['cid']]);
        }
        if ($args['select']) {
            $object->select((array)$args['select']);
        }
        if ($args['keyword']) {
            $object->Where(['like', 't.name', $args['keyword']]);
        }

        //属性值搜索
        if ($args['vid']) {
            $goodIDs = [];
            $first = 1;
            foreach ((array)$args['vid'] as $v) {
                $attrValMap = GoodsAttrValMap::find()
                    ->select(['gid'])
                    ->where(['vid' => $v])
                    ->asArray()
                    ->groupBy(['gid'])
                    ->all();
                $gids = array_map(function($a){return $a['gid'];}, $attrValMap);

                //如果没有找到对应的商品ID，说明没有对应属性值的商品，直接返回空数组
                if (!$gids) {
                    return 0;
                }

                //第一次将值赋值goodIDs，之后循环都和之前的接口进行交集运算
                if ($first == 1) {
                    $goodIDs = $gids;
                } else {
                    $goodIDs = array_intersect($goodIDs, $gids);
                }

                $first++;
            }

            //如果没有找到对应的商品ID，说明没有对应属性值的商品，直接返回空数组
            if (!$goodIDs) {
                return 0;
            }
            $object->andFilterWhere(['id' => $goodIDs]);
        }

        return $object->count();
    }

    /**
     * @brief 根据分类统计商品数量
     * @return array|\yii\db\ActiveRecord[]
     * <pre>
     *      [
     *          [
     *              'num' => 数量,
     *              'cid' => 类别ID,
     *              'name' => '分类名称'
     *          ],
     *      ]
     * </pre>
     * @author wuzhc 2016-08-17
     */
    public function statByCategoryID()
    {
        return Goods::find()->from(Goods::tableName() . 'as t')
            ->leftJoin(Category::tableName() . 'as cat', 'cat.id = t.cid')
            ->select(['count(t.id) as num','t.cid', 'cat.name'])
            ->groupBy('t.cid')
            ->asArray()
            ->all();
    }

    /**
     * @brief 商品信息
     * @param $goodsID
     * @return array
     * @author wuzhc 2016-08-17
     */
    public function detail($goodsID)
    {
        $return = [];

        $object = Goods::findOne($goodsID);
        if (!$object) {
            return $return;
        }

        $return['id'] = $object->id;
        $return['name'] = $object->name;
        $return['img'] = $object->img;
        $return['adImg'] = $object->ad_img;
        $return['createTime'] = $object->create_time;

        $return['photos'] = $object->images();
        $return['comments'] = $object->comments();
        $return['attrVals'] = $object->attrVals();

        return $return;
    }


}