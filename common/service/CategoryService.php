<?php

namespace common\service;

use common\models\CategoryAttrMap;
use common\config\Conf;
use common\hybrid\AbstractHybrid;
use common\hybrid\CategoryHybrid;
use common\models\Attr;
use Yii;
use common\models\Category;

class CategoryService extends AbstractService
{

    //region 类别管理

    /**
     * Returns the static model.
     * @param string $className Service class name.
     * @return CategoryService the static model class
     */
    public static function factory($className=__CLASS__)
    {
        return parent::factory($className);
    }

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
     * @author wuzhc 2016-07-31
     */
    public function getCategoriesBySort()
    {
        if (Yii::$app->cache->exists(Conf::CATEGORIES_BY_SORT)) {
            return Yii::$app->cache->get(Conf::CATEGORIES_BY_SORT);
        }

        $categories = Category::find()
            ->select(['id', 'name', 'parent_id'])
            ->orderBy(['sort' => SORT_DESC, 'id' => SORT_DESC])
            ->asArray()
            ->all();

        $data = $this->_recurToData($categories, 0);
        if ($data) {
            Yii::$app->cache->set(Conf::CATEGORIES_BY_SORT, $data);
        }

        return $data;
    }

    /**
     * @brief 递归处理数据
     * @param $arr
     * @param int $id
     * @return array
     * @author wuzhc 2016-07-31
     */
    private function _recurToData($arr, $id = 0)
    {
        static $data = array();
        static $level = 0;
        $temp = array();
        foreach($arr as $k => $c) {
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
     * @author wuzhc 2016-07-31
     */
    public function getCategoriesTree()
    {
        if (Yii::$app->cache->exists(Conf::CATEGORIES_TREE_CACHE)) {
            return Yii::$app->cache->get(Conf::CATEGORIES_TREE_CACHE);
        }

        $categories = Category::find()
            ->select(['id', 'name', 'parent_id', 'sort'])
            ->orderBy(['sort' => SORT_DESC, 'id' => SORT_DESC])
            ->asArray()
            ->all();

        $data = $this->_recurToDataTree($categories, 0);
        if ($data) {
            Yii::$app->cache->set(Conf::CATEGORIES_TREE_CACHE, $data);
        }

        return $data;
    }

    /**
     * @brief 递归处理数据
     * @param $arr
     * @param int $id
     * @return array
     * @author wuzhc 2016-07-31
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
     * @author wuzhc 2016-07-31
     */
    public function getCategoriesMap()
    {
        if (Yii::$app->cache->exists(Conf::CATEGORIES_MAP_CACHE)) {
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

        if ($data) {
            Yii::$app->cache->set(Conf::CATEGORIES_MAP_CACHE, $data);
        }

        return $data;
    }

    /**
     * @brief 保存或更新数据
     * @param $data
     * @return int|string
     * @author wuzhc 2016-07-31
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
     * @author wuzhc 2016-07-31
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
     * @author wuzhc 2016-08-03
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
     * @author wuzhc 2016-08-03
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


    //endregion 类别管理

    //region 属性管理

    /**
     * @brief 保存属性
     * @param $args
     * @return bool
     * @author wuzhc 2016-08-02
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
     * @author wuzhc 2016-08-02
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
     * @author wuzhc 2016-08-03
     */
    public function addAttrValue($args)
    {
        $attrValue = new CategoryHybrid();
        return $attrValue->saveAttrValue($args);
    }

    /**
     * @brief 批量保存属性
     * @param $args
     * @return int
     * @author wuzhc 2016-08-02
     */
    public function batchAddAttrValue($args)
    {
        $attr = new AbstractHybrid();
        return $attr->batchSave(Attr::tableName(), ['aid','name','sort','status'], $args);
    }


    //endregion 属性管理
}