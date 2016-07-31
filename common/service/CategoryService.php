<?php

namespace common\service;

use common\config\Conf;
use common\hybrid\CategoryHybrid;
use Yii;
use common\models\Category;

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
     * @brief 保存数据，保存成功之后就删除旧缓存
     * @param $data
     * @return int|string
     * @author wuzhc 2016-07-31
     */
    public function save($data)
    {
        $categoryHybrid = new CategoryHybrid();
        return $categoryHybrid->save($data);
    }

}