<?php

namespace common\service;


use common\models\GoodsPhoto;
use common\models\GoodsPhotoRelation;
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

    public function save($args)
    {

        if ($args['is_del'] == Conf::DOWN_GOODS) {
            $args['down_time'] = DateTime::date('Y-m-d H:i:s');
        } elseif ($args['is_del'] == Conf::UP_GOODS) {
            $args['up_time'] = DateTime::date('Y-m-d H:i:s');
        }

        $hybrid = new AbstractHybrid();
        $goodsHybrid = new GoodsHybrid();

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

        //保存商品图集
        if ($args['photo']) {
            GoodsPhotoRelation::deleteAll(['goods_id' => $goodsID]);
            $photos = [];
            $root = Yii::getAlias('@webroot');
            foreach (($args['photo']) as $img) {
                $filename = $root . DIRECTORY_SEPARATOR . $img;
                if (!is_file($filename)) {
                    continue;
                }
                $goodsPhotoID = $goodsHybrid->saveGoodsPhoto(md5_file($filename), $img);
                if (!$goodsPhotoID) {
                    continue;
                }
                $photos[] = [$goodsID, $goodsPhotoID];
            }
            $hybrid->batchSave(GoodsPhotoRelation::tableName(), ['goods_id', 'photo_id'], $photos);
        }

        return true;
    }


}