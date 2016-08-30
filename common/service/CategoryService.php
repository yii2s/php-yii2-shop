<?php

namespace common\service;

use common\models\AttrValue;
use common\models\CategoryAttrMap;
use common\config\Conf;
use common\hybrid\AbstractHybrid;
use common\hybrid\CategoryHybrid;
use common\models\Attr;
use common\models\CategoryAttrValMap;
use Yii;
use common\models\Category;
use yii\helpers\ArrayHelper;

class CategoryService extends AbstractService
{

    /**
     * Returns the static model.
     * @param string $className Service class name.
     * @return CategoryService the static model class
     */
    public static function factory($className=__CLASS__)
    {
        return parent::factory($className);
    }

    //region 类别管理

    /**
     * 根据父ID获取子分类
     * @param $parentID
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getChildren($parentID = 0)
    {
        return Category::find()
            ->select(['id', 'name'])
            ->where(['parent_id' => $parentID])
            ->orderBy(['sort' => SORT_DESC, 'id' => SORT_DESC])
            ->asArray()
            ->all();
    }

    /**
     * @brief 获取排序后所有的分类
     * @return array
     * @since 2016-07-31
     */
    public function getCategoriesBySort()
    {
        if (CACHE_ON && Yii::$app->cache->exists(Conf::CATEGORIES_BY_SORT)) {
            return Yii::$app->cache->get(Conf::CATEGORIES_BY_SORT);
        }

        $categories = Category::find()
            ->select(['id', 'name', 'parent_id'])
            ->orderBy(['sort' => SORT_DESC, 'id' => SORT_DESC])
            ->asArray()
            ->all();

        $data = $this->_recurToData($categories, 0);
        if (CACHE_ON && $data) {
            Yii::$app->cache->set(Conf::CATEGORIES_BY_SORT, $data);
        }

        return $data;
    }

    /**
     * @brief 递归处理数据
     * @param $arr
     * @param int $id
     * @return array
     * @since 2016-07-31
     */
    private function _recurToData($arr, $id = 0)
    {
        static $data = array();
        static $level = 0;

        foreach($arr as $k => $c) {
            $temp = array();
            if ($c['parent_id'] == $id) {
                $temp['id'] = $c['id'];
                $temp['name'] = $c['name'];
                $temp['parentID'] = $c['parent_id'];
                $temp['level'] = $level;
                $data[] = $temp;

                unset($arr[$k]);
                $level++;
                $this->_recurToData($arr, $c['id']);
                $level--;
            }
        }
        return $data;
    }

    /**
     * @brief 获取排序后所有的分类
     * @return array
     * @since 2016-07-31
     */
    public function getCategoriesTree()
    {
        if (CACHE_ON && Yii::$app->cache->exists(Conf::CATEGORIES_TREE_CACHE)) {
            return Yii::$app->cache->get(Conf::CATEGORIES_TREE_CACHE);
        }

        $categories = Category::find()
            ->select(['id', 'name', 'parent_id', 'sort'])
            ->orderBy(['sort' => SORT_DESC, 'id' => SORT_DESC])
            ->asArray()
            ->all();

        $data = $this->_recurToDataTree($categories, 0);
        if (CACHE_ON && $data) {
            Yii::$app->cache->set(Conf::CATEGORIES_TREE_CACHE, $data);
        }

        return $data;
    }

    /**
     * @brief 递归处理数据
     * @param $arr
     * @param int $id
     * @return array
     * @since 2016-07-31
     */
    private function _recurToDataTree($arr, $id = 0)
    {
        $data = $temp = array();
        foreach($arr as $k => $c) {
            if ($c['parent_id'] == $id) {
                $temp['id'] = $c['id'];
                $temp['text'] = $c['name'];
                $temp['name'] = $c['name'];
                $temp['sort'] = $c['sort'];

                unset($arr[$k]);
                $temp['children'] = $this->_recurToDataTree($arr, $c['id']);

                if (empty($temp['children'])) {
                    unset($temp['children']);
                }
                $data[] = $temp;
            }
        }
        return $data;
    }

    /**
     * @brief 获取分类,以分类父ID作业键名进行分组
     * @return array|mixed
     * @since 2016-07-31
     */
    public function getCategoriesMap()
    {
        if (CACHE_ON && Yii::$app->cache->exists(Conf::CATEGORIES_MAP_CACHE)) {
            return Yii::$app->cache->get(Conf::CATEGORIES_MAP_CACHE);
        }

        $categories = Category::find()
            ->select(['id', 'name', 'parent_id'])
            ->orderBy(['sort' => SORT_DESC, 'id' => SORT_DESC])
            ->asArray()
            ->all();

        $temp = $data = array();
        foreach ($categories as $k => $c) {
            $temp['id'] = $c['id'];
            $temp['name'] = $c['name'];
            $data[$c['parent_id']][] = $temp;
        }

        if (CACHE_ON && $data) {
            Yii::$app->cache->set(Conf::CATEGORIES_MAP_CACHE, $data);
        }

        return $data;
    }

    /**
     * @brief 保存或更新数据
     * @param $data
     * @return int|string
     * @since 2016-07-31
     */
    public function save($data)
    {
        $categoryHybrid = new CategoryHybrid();
        return $categoryHybrid->save($data);
    }

    /**
     * @brief 删除分类，包括所有子类删除
     * @param $id
     * @return bool|false|int
     * @since 2016-07-31
     */
    public function del($id)
    {
        $category = Category::findOne($id);
        if (!$category) {
            return false;
        }
        $childrenIDs = $this->getChildrenIDs($category->id);
        if ($category->delete()) {
            return Category::deleteAll(['id' => $childrenIDs]);
        } else {
            return false;
        }
    }

    /**
     * @brief 获取所有子类ID
     * @param $parentID
     * @return array
     * @since 2016-08-03
     */
    public function getChildrenIDs($parentID)
    {
        $parentIDArr[] = $parentID;
        while (True) {
            $parentID = current($parentIDArr);
            $records = Category::find()->select('id')->where(['parent_id' => $parentID])->all();
            foreach ((array)$records as $r) {
                if (!in_array($r->id, $parentIDArr)) {
                    $parentIDArr[] = $r->id;
                }
            }
            if (next($parentIDArr) === false) {
                break;
            }
        }
        array_shift($parentIDArr);
        return $parentIDArr;
    }

    /**
     * 分类关联属性
     * @param $categoryID
     * @param array $attrIDs
     * @return int
     * @since 2016-08-03
     */
    public function saveCategoryAttrMap($categoryID, array $attrIDs)
    {
        //delete previous data,
        CategoryAttrMap::deleteAll(['cid' => $categoryID]);

        // add new data
        $data = [];
        foreach ($attrIDs as $aid) {
            $data[] = [$categoryID, $aid];
        }
        $attr = new AbstractHybrid();
        return $attr->batchSave(CategoryAttrMap::tableName(), ['cid','aid'], $data);
    }

    /**
     * @brief 批量关联分类和属性值
     * @param $categoryID
     * @param $args
     * @return int
     * @since 2016-08-05
     */
    public function saveCategoryAttrValMap($categoryID, $aid, $args)
    {
        //delete previous data,
        CategoryAttrValMap::deleteAll(['cid' => $categoryID, 'aid' => $aid]);

        $attr = new AbstractHybrid();
        return $attr->batchSave(CategoryAttrValMap::tableName(), ['cid','aid','vid','sort'], $args);
    }

    /**
     * @brief 获取分类ID获取关联的属性值
     * @param int $categoryID
     * @return array
     * @since 2016-08-05
     */
    public function getAttrValsByCatsID($categoryID)
    {
        $record = Category::find()
            ->with('attrVals')
            ->where(['id' => $categoryID])
            ->asArray()
            ->one();
        return $record['attrVals'];
    }

    /**
     * @brief 修改分类名称
     * @param int $cid 分类ID
     * @param string $name 名称
     * @return bool
     * @since 2016-08-28
     */
    public function editName($cid, $name)
    {
        $categoryHybrid = new CategoryHybrid();
        return $categoryHybrid->save(['id' => $cid, 'name' => $name]);
    }

    /**
     * @brief 获取多层父类
     * @param $id
     * @return array
     * <pre>
     *      [
     *          ['id' => 1， 'name' => '电器', 'parentID' => 0],
     *          ['id' => 2， 'name' => '电灯', 'parentID' => 1],
     *          ['id' => 3， 'name' => 'LED', 'parentID' => 2],
     *      ]
     * </pre>
     * @since 2016-08-28
     */
    public function getParentCats($id)
    {
        $result = [];
        $findIDs[] = $id;

        while (true) {
            $temp = [];
            $id = current($findIDs);

            $cat = Category::findOne($id);
            if (!$cat || $cat->parent_id === 0) {
                break;
            }

            $temp['id'] = $cat->id;
            $temp['name'] = $cat->name;
            $temp['parentID'] = $cat->parent_id;
            array_unshift($result, $temp);

            $findIDs[] = $cat->parent_id;
            next($findIDs);
        }

        return $result;
    }

    //endregion 类别管理

    //region 属性管理

    /**
     * @brief 保存属性
     * @param $args
     * @return bool
     * @since 2016-08-02
     */
    public function addAttr($args)
    {
        $attr = new CategoryHybrid();
        return $attr->saveAttr($args);
    }

    /**
     * @brief 批量保存属性
     * @param $args
     * @return int
     * @since 2016-08-02
     */
    public function batchAddAttr($args)
    {
        $attr = new AbstractHybrid();
        return $attr->batchSave(Attr::tableName(), ['name','sort','status'], $args);
    }

    /**
     * @brief 插入属性值
     * @param $args
     * @return bool
     * @since 2016-08-03
     */
    public function addAttrValue($args)
    {
        $attrValue = new CategoryHybrid();
        return $attrValue->saveAttrValue($args);
    }

    /**
     * @brief 批量保存属性值
     * @param int $aid 属性ID
     * @param array $args
     * @return int
     * @since 2016-08-02
     */
    public function batchAddAttrValue($aid, $args)
    {
        if (empty($aid)) {
            return false;
        }

        //删除旧数据
        AttrValue::deleteAll(['aid' => $aid]);

        $attr = new AbstractHybrid();
        return $attr->batchSave(AttrValue::tableName(), ['aid','name'], $args);
    }

    /**
     * @brief 保存品牌
     * @param $args
     * @return int
     * @since 2016-08-04
     */
    public function addBrand($args)
    {
        $attrValue = new CategoryHybrid();
        return $attrValue->saveBrand($args);
    }

    /**
     * @brief 根据分类ID获取属性
     * @param int $categoryID
     * @since 2016-08-05
     * @return array
     */
    public function getAttrsByCategoryID($categoryID)
    {
        return Category::findOne($categoryID)->attrs ?: [];
    }

    /**
     * @brief 获取分类对应的属性值
     * @param $cid
     * @return array
     * @since 2016-08-15
     */
    public function getAttrValByCid($cid)
    {
        //分类对应属性值
        $catVals = Category::findOne($cid)->attrVals;
        $val = $temp = array();
        foreach ($catVals as $v) {
            $temp['id'] = $v->id;
            $temp['name'] = $v->name;
            $val[$v->aid][] = $temp;
        }

        //分类对应属性
        $catAttrs = Category::findOne($cid)->attrs;
        $attr = $temp = array();
        foreach ($catAttrs as $a) {
            $temp['id'] = $a->id;
            $temp['name'] = $a->name;
            $temp['value'] = $val[$a->id] ?: array();
            $attr[] = $temp;
        }

        return $attr;
    }

    /**
     * @brief 属性值列表
     * @param $args
     * @param bool|true $asArray
     * @return array|\yii\db\ActiveRecord[]
     * @since 2016-08-05
     */
    public function listAttrVal($args, $asArray = true)
    {
        $attrVal = AttrValue::find();
        if ($args['attrID']) {
            $attrVal->where(['aid' => intval($args['attrID'])]);
        }
        if ($args['start']) {
            $attrVal->offset(intval($args['start']));
        }
        if ($args['limit']) {
            $attrVal->limit(intval($args['limit']));
        }
        return $attrVal->orderBy(['id' => SORT_DESC, 'sort' => SORT_ASC])
            ->asArray($asArray)
            ->all();
    }

    /**
     * @brief 统计属性值
     * @param $args
     * @return int|string
     * @since 2016-08-05
     */
    public function countAttrVal($args)
    {
        $attrVal = AttrValue::find();
        if ($args['attrID']) {
            $attrVal->where(['aid' => intval($args['attrID'])]);
        }
        return $attrVal->count();
    }


    //endregion 属性管理

    //region 规格管理

    //endregion
}