<?php

namespace common\hybrid;


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
        $object->parent_id = $args['parent_id'];
        $object->sort = $args['sort'] ?: 0;
        $object->visibility = $args['visibility'] ?: 1;
        $object->keywords = $args['keywords'];
        $object->descript = $args['descript'];
        $object->title = $args['title'];
        $object->seller_id = $args['seller_id'] ?: 0;

        $object->save();
        $this->id = $object->id;
        return $this->id;
    }
}