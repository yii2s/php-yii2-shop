<?php

namespace common\service;


use common\models\Goods;
use common\models\GoodsAttribute;
use common\models\GoodsAttrValMap;
use common\models\GoodsImage;
use common\models\GoodsPhoto;
use common\models\GoodsPhotoRelation;
use common\utils\ImageUtil;
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

        if ($args['is_del'] == Conf::DOWN_GOODS) {
            $args['down_time'] = DateTime::date('Y-m-d H:i:s');
        } elseif ($args['is_del'] == Conf::UP_GOODS) {
            $args['up_time'] = DateTime::date('Y-m-d H:i:s');
        }

        $hybrid = new AbstractHybrid();
        $goodsHybrid = new GoodsHybrid();

        if ($args['mainImg'] && is_file($args['mainImg'])) {
            $args['img'] = $args['mainImg'];
            $args['ad_img'] = ImageUtil::thumbnail($args['mainImg'], 220, 220);
            unset($args['mainImg']);
        }

        //保存商品基本数据
        $goodsID = $goodsHybrid->save($args);
        if (!$goodsID) {
            echo 'goodsID';
            return false;
        }

        //保存推荐
        if ($args['recommend']) {
            CommentGoods::deleteAll(['goods_id' => $goodsID]);
            $recommend = [];
            foreach (($args['recommend']) as $commendID) {
                $recommend[] = [$commendID, $goodsID];
            }
            $hybrid->batchSave(CommentGoods::tableName(),['commend_id','goods_id'], $recommend);
        }

        if ($args['photo']) {
            GoodsImage::deleteAll(['gid' => $goodsID]);
            $photos = [];
            foreach (($args['photo']) as $img) {
                $filename = Yii::getAlias('@webroot') . DIRECTORY_SEPARATOR . $img;
                if (!is_file($filename)) {
                    continue;
                }
                $photos[] = [$goodsID, $img];
                ImageUtil::thumbnail($img, 50, 50);
                ImageUtil::thumbnail($img, 220, 220);
            }
            $hybrid->batchSave(GoodsImage::tableName(), ['gid', 'img'], $photos);
        }

        //保存商品属性值
        if ($args['attr_vid']) {
            $goodsAttrValMap = [];
            foreach ((array)$args['attr_vid'] as $avid) {
                list($aid, $vid) = explode('-', $avid);
                $goodsAttrValMap[] = [$goodsID, intval($aid), intval($vid)];
            }
            $hybrid->batchSave(GoodsAttrValMap::tableName(), ['gid', 'aid', 'vid'], $goodsAttrValMap);
        }

        return true;
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


}