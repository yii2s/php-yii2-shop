<?php

namespace common\hybrid;


use common\models\AttrValue;
use common\models\Brand;
use common\models\Spec;
use Yii;
use common\models\Attr;
use common\models\Category;

class CategoryHybrid extends AbstractHybrid
{
    public $id;

    public function __construct($id = 0)
    {
        $this->id = $id;
    }

    /**
     * @brief 保存或修改数据
     * @param $args
     * @return int|string
     * @since 2016-07-31
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
     * @brief 保存或修改属性
     * @param $args
     * @return bool
     * @since 2016-08-02
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
     * @brief 保存或修改属性值
     * @param $args
     * @return bool
     * @since 2016-08-03
     */
    public function saveAttrValue($args)
    {
        if ($args['id']) {
            $object = AttrValue::findOne(['id' => $args['id']]);
        } else {
            $object = new AttrValue();
        }
        $object->aid = (int)$args['aid'];
        $object->name = $args['name'];
        $object->status = (int)$args['status'] ?: 0;
        $object->sort = (int)$args['sort'] ?: 0;
        return $object->save() ? $object->id : 0;
    }

    /**
     * @brief 保存品牌
     * @param $args
     * @return int|string
     * @since 2016-08-04
     */
    public function saveBrand($args)
    {
        if ($args['id']) {
            $object = Brand::findOne(['id' => $args['id']]);
        } else {
            $object = new Brand();
        }

        $object->vid = (int)$args['vid'];
        $object->name = $args['name'];
        $object->logo = $args['logo'];
        $object->url = $args['url'];
        $object->sort = (int)$args['sort'];
        $object->description = $args['description'];
        return $object->save() ? $object->id : 0;
    }

    /**
     * @brief 保存规格
     * @param $args
     * @return int|string
     * @since 2016-08-31
     */
    public function saveSpec($args)
    {
        if ($args['id']) {
            $object = Spec::findOne(['id' => $args['id']]);
        } else {
            $object = new Spec();
        }

        $object->name = $args['name'];
        $object->value = $args['value'];
        $object->type = $args['type'];
        $object->note = $args['note'];
        $object->is_del = (int)$args['is_del'];
        $object->seller_id = (int)$args['seller_id'];
        return $object->save() ? $object->id : 0;
    }

}