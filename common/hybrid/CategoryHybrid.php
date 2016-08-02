<?php

namespace common\hybrid;


use Yii;
use common\models\Attr;
use common\models\Category;

class CategoryHybrid
{
    public $id;

    public function __construct($id = 0)
    {
        $this->id = $id;
    }

    /**
     * @brief 保存数据
     * @param $args
     * @return int|string
     * @author wuzhc 2016-07-31
     */
    public function save($args)
    {
        if ($args['id']) {
            $object = Category::findOne(['id' => $args['id']]);
        } else {
            $object = new Category();
        }
        $object->name = $args['name'];
        $object->parent_id = (int)$args['parent_id'];
        $object->sort = (int)$args['sort'] ?: 0;
        $object->visibility = (int)$args['visibility'] ?: 1;
        $object->keywords = $args['keywords'];
        $object->descript = $args['descript'];
        $object->title = $args['title'];
        $object->seller_id = (int)$args['seller_id'] ?: 0;

        $object->save();
        $this->id = $object->id;
        return $this->id;
    }

    /**
     * @brief 保存属性
     * @param $args
     * @return bool
     * @author wuzhc 2016-08-02
     */
    public function saveAttr($args)
    {
        if ($args['id']) {
            $object = Attr::findOne(['id' => $args['id']]);
        } else {
            $object = new Attr();
        }
        $object->name = $args['name'];
        $object->status = (int)$args['status'] ?: 0;
        $object->sort = (int)$args['sort'] ?: 0;
        return $object->save();
    }

    /**
     * @brief 批量插入属性
     * @param $args
     * @return int
     * @throws \yii\db\Exception
     * @author wuzhc 2016-08-02
     */
    public function batchSaveAttr($args)
    {
        return Yii::$app->db->createCommand()->batchInsert(
            Attr::tableName(),
            ['name','sort','status'],
            $args
        )->execute();
    }
}