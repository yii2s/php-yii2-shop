<?php

namespace common\behaviors;


use common\config\Conf;
use common\models\Attr;
use common\models\AttrValue;
use common\models\Comment;
use common\models\Goods;
use common\models\GoodsAttrValMap;
use common\models\User;
use Yii;
use common\utils\FileUtil;
use yii\base\Behavior;
use yii\helpers\ArrayHelper;

class GoodsBehavior extends Behavior
{

    /**
     * @brief 获取商品图集
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
     * @author wuzhc 2016-08-17
     */
    public function images()
    {
        //缩略图规格
        $thumbStandards = Yii::$app->params['thumbStandards'];
        $thumbStandards = array_map(function($t) {return implode('_', $t);}, $thumbStandards);

        $images = $this->owner->image;

        $data = $temp = [];
        foreach ($images as $i) {
            $temp['s0'] = $i->img;
            foreach ($thumbStandards as $k => $standard) {
                $standardName = basename($i->img, FileUtil::suffix($i->img, true)) . '_' . $standard;
                $temp[$k] = FileUtil::newName($i->img, $standardName);
            }
            $data[] = $temp;
        }
        return $data;
    }

    /**
     * @brief 获取属性值
     * @return array|\yii\db\ActiveRecord[]
     * <pre>
     * [
     *      [
     *          'attr' => 品牌,
     *          'val' => 金六福
     *      ],
     * ]
     * </pre>
     * @author wuzhc 2016-08-17
     */
    public function attrVals()
    {
        return Goods::find()->from(Goods::tableName() . 'as t')
            ->leftJoin(GoodsAttrValMap::tableName() . 'as gavm', 'gavm.gid = t.id')
            ->leftJoin(AttrValue::tableName() . 'as av', 'av.id = gavm.vid')
            ->leftJoin(Attr::tableName() . 'as a', 'a.id = gavm.aid')
            ->where(['t.id' => $this->owner->id])
            ->select(['a.name as attr', 'av.name as val'])
            ->asArray()
            ->all();
    }

    /**
     * @brief 获取评论
     * @return array|\yii\db\ActiveRecord[]
     * <pre>
     *
     * </pre>
     * @author wuzhc 2016-08-17
     */
    public function comments()
    {
        return Goods::find()->from(Goods::tableName() . 'as t')
            ->leftJoin(Comment::tableName() . 'as comment', 'comment.goods_id = t.id')
            ->leftJoin(User::tableName() . 'as user', 'user.id = comment.user_id')
            ->select([
                'comment.id as comment_id',
                'comment.contents as content',
                'comment.comment_time as create_time',
                'user.username as username',
                'user.head_ico as head_ico'
            ])
            ->where(['t.id' => $this->owner->id])
            ->where(['comment.status' => Conf::ENABLE])
            ->asArray()
            ->all();
    }

}