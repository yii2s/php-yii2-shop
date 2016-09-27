<?php

namespace common\behaviors;


use common\config\Conf;
use common\models\Attr;
use common\models\AttrValue;
use common\models\Comment;
use common\models\Goods;
use common\models\GoodsAttrValMap;
use common\models\GoodsExtAttr;
use common\models\Member;
use common\models\Products;
use common\models\User;
use Yii;
use common\utils\FileUtil;
use yii\base\Behavior;
use yii\helpers\ArrayHelper;

class GoodsBehavior extends Behavior
{

    /**
     * 获取商品图集
     * @param int $limit 返回记录条数，默认只返回6条记录
     * @return array
     * <pre>
     * [
     *      [
     *          's0' => uploads/tempFile/Penguins.jpg           原图
     *          's1' => uploads/tempFile/Penguins_200_120.jpg   缩略图1
     *          's2' => uploads/tempFile/Penguins_50_50.jpg     缩略图2
     *      ]
     * ]
     * </pre>
     * @since 2016-08-17
     */
    public function images($limit = 6)
    {
        $result = [];

        $thumbStandards = Yii::$app->params['thumbStandards'];
        $thumbStandards = array_map(function($t) {return implode('_', $t);}, $thumbStandards);

        $images = $this->owner->image;
        foreach ($images as $key => $img) {
            $temp = [];
            if ($key >= $limit) {
                break;
            }

            $temp['s0'] = $img->img;
            foreach ($thumbStandards as $flag => $standard) {
                $standardName = basename($img->img, FileUtil::suffix($img->img, true)) . '_thumb_' . $standard;
                $temp[$flag] = FileUtil::newName($img->img, $standardName);
            }
            $result[] = $temp;
        }
        return $result;
    }

    /**
     * @brief 获取属性值
     * @return array|\yii\db\ActiveRecord[]
     * <pre>
     * [
     *      [ 'attr' => 品牌, 'val' => 金六福 ],
     *      [ 'attr' => 品牌, 'val' => 金六福 ],
     * ]
     * </pre>
     * @since 2016-08-17
     */
    public function sysAttr()
    {
        $data = array();

        $attrs = Goods::find()->from(Goods::tableName() . 'as t')
            ->leftJoin(GoodsAttrValMap::tableName() . 'as gavm', 'gavm.gid = t.id')
            ->leftJoin(AttrValue::tableName() . 'as av', 'av.id = gavm.vid')
            ->leftJoin(Attr::tableName() . 'as a', 'a.id = gavm.aid')
            ->where(['t.id' => $this->owner->id])
            ->select(['a.name as name', 'av.name as val'])
            ->asArray()
            ->all();

        if ($attrs) {
            foreach ($attrs as $attr) {
                if (!$attr['name']) {
                    continue;
                }
                $data[$attr['name']][] = $attr['val'];
            }
        }

        return $data;
    }

    /**
     * @brief 扩展属性
     * @return array|\yii\db\ActiveRecord[]
     * <pre>
     *  [
     *      ['name' => '属性名称', 'value' => '属性值'],
     *      ['name' => '属性名称', 'value' => '属性值'],
     * ]
     * </pre>
     * @since 2016-08-30
     */
    public function extAttr()
    {
        return Goods::find()->from(Goods::tableName() . 'as t')
            ->leftJoin(GoodsExtAttr::tableName() . 'as extattr', 'extattr.gid = t.id')
            ->select(['extattr.name', 'extattr.value'])
            ->where(['t.id' => $this->owner->id, 'extattr.status' => Conf::ENABLE])
            ->asArray()
            ->all();
    }

    /**
     * @brief 获取评论
     * @return array|\yii\db\ActiveRecord[]
     * <pre>
     *
     * </pre>
     * @since 2016-08-17
     */
    public function comments()
    {
        return Goods::find()->from(Goods::tableName() . 'as t')
            ->leftJoin(Comment::tableName() . 'as comment', 'comment.goods_id = t.id')
            ->leftJoin(Member::tableName() . 'as member', 'member.id = comment.user_id')
            ->select([
                'comment.id as comment_id',
                'comment.contents as content',
                'comment.comment_time as create_time',
                'member.username as username',
                'member.headerImg as header_img'
            ])
            ->where(['t.id' => $this->owner->id])
            ->where(['comment.status' => Conf::ENABLE])
            ->asArray()
            ->all();
    }

}