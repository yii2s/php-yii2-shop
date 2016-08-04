<?php
namespace backend\controllers;


use common\config\Conf;
use common\models\Attr;
use common\models\AttrValMap;
use common\models\Categories;
use common\models\Category;
use common\service\CategoryService;
use common\utils\ExcelUtil;
use common\utils\ResponseUtil;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Response;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\web\Controller;
use yii\filters\VerbFilter;
use backend\form\LoginForm;

class CategoryController extends Controller
{

    public $enableCsrfValidation = false;

    public function actionTest()
    {
        $filePath = Yii::getAlias('@uploads') . '/tempFile/sg.xls';
        $data = ExcelUtil::read($filePath);
        echo '总计：' . count($data['data']);
        echo PHP_EOL;
        print_r($data['data']);
    }

    /**
     * @brief 添加类别
     * @author wuzhc 2016-07-31
     */
    public function actionAdd()
    {
        if (Yii::$app->request->isPost)
        {
            $data = Yii::$app->request->post();
            list($status, $msg) = CategoryService::factory()->save($data)
                ? [0, '保存成功'] : [1, '保存失败'];
            ResponseUtil::json(null, $status, $msg);
        }
        else
        {
            $id = (int)Yii::$app->request->get('id');
            $curCategory = array();
            if ($id) {
                $curCategory = Category::findOne($id);
                $parentName = Category::findOne($curCategory->parent_id)->name;
            }
            return $this->render('add', [
                'parentName' => $parentName,
                'curCategory' => $curCategory,
                'categories' => CategoryService::factory()->getCategoriesMap()
            ]);
        }
    }

    /**
     * @brief 删除分类
     * @author wuzhc 2016-08-02
     */
    public function actionDel()
    {
        $id = (int)Yii::$app->request->get('id');
        list($status, $msg) = CategoryService::factory()->del($id) 
            ? [0, '删除成功'] : [1, '删除失败'];
        ResponseUtil::json(null, $status, $msg);
    }

    /**
     * @brief 分类列表
     * @return string
     * @author wuzhc 2016-07-31
     */
    public function actionList()
    {
        $categories = CategoryService::factory()->getCategoriesTree();
        return $this->render('list',[
            'categories' => Json::encode($categories)
        ]);
    }

    /**
     * @brief 关联属性
     * @author wuzhc 2016-08-03
     */
    public function actionCategoryAttrMap()
    {
        if (Yii::$app->request->isPost) {
            $categoryID = (int)Yii::$app->request->post('categoryID');
            $attrIDs = Yii::$app->request->post('attrIDs');
            $attrIDs = array_map('intval', explode(',', $attrIDs));
            list($status, $msg) = CategoryService::factory()->saveCategoryAttrMap($categoryID, $attrIDs)
                ? [0, '操作成功'] : [1, '操作失败'];
            ResponseUtil::json(null, $status, $msg);
        }
        else
        {
            $id = (int)Yii::$app->request->get('categoryID');
            $category = array();
            if ($id) {
                $category = Category::findOne($id);
                $caMaps = $category->categoryAttrMaps;
                $attrIDs = implode(',', ArrayHelper::getColumn($caMaps, 'aid'));
            }
            $attrs = Attr::find()->all();
            $attrs = ArrayHelper::map($attrs, 'id', 'name');
            $attrs = Json::encode($attrs);

            return $this->render('categoryAttrMap', [
                'curCategory' => $category,
                'attrs' => $attrs,
                'attrIDs' => $attrIDs,
                'categories' => CategoryService::factory()->getCategoriesMap()
            ]);
        }
    }

    public function actionTest1()
    {
        $data = CategoryService::factory()->getCategoryAttr(12);
        print_r($data);
    }

    /**
     * @brief 分类关联属性值
     * @author wuzhc 2016-08-04
     */
    public function actionCategoryAttrValMap()
    {
        $data['cid'] = 12;
        $data['vid'] = [3,5,6];
        if ($data) {
            $cid = (int)$data['cid'];   //类别ID
            $vid = $data['vid'];   //属性值ID

            $args = $temp = [];
            foreach ($vid as $v) {
                $temp['cid'] = $cid;
                $temp['vid'] = $v;
                $temp['sort'] = 0;
                $args[] = $temp;
            }

            list($status, $msg) = CategoryService::factory()->saveCategoryAttrValMap($args)
                ? [0, '操作成功'] : [1, '操作失败'];
            ResponseUtil::json(null, $status, $msg);
        }
        else
        {
            return $this->render('categoryAttrValMap');
        }
    }

    /**
     * @brief 缓存处理
     * @author wuzhc 2016-07-31
     */
    public function actionCache()
    {
        if (!Yii::$app->request->isAjax) {
            Yii::$app->end('Invalid Request');
        }

        Yii::$app->cache->delete(Conf::CATEGORIES_MAP_CACHE);
        $data = CategoryService::factory()->getCategoriesMap();
        if ($data) {
            Yii::$app->cache->set(Conf::CATEGORIES_MAP_CACHE, $data);
        }

        Yii::$app->cache->delete(Conf::CATEGORIES_BY_SORT);
        $data = CategoryService::factory()->getCategoriesBySort();
        if ($data) {
            Yii::$app->cache->set(Conf::CATEGORIES_BY_SORT, $data);
        }

        Yii::$app->cache->delete(Conf::CATEGORIES_TREE_CACHE);
        $data = CategoryService::factory()->getCategoriesTree();
        if ($data) {
            Yii::$app->cache->set(Conf::CATEGORIES_TREE_CACHE, $data);
        }
    }

    /**
     * @deprecated 删除分类
     * @since 2016-03-12
     */
    public function actionDelete()
    {
        $id = (int)Yii::$app->request->get('id');
        $category = new Categories();
        if ($category->deleteCategory($id)) {
            echo '删除成功';
        } else {
            echo '删除失败';
        }

    }

    /**
     * @deprecated
     */
    public function actionList_old()
    {
        header('Content-type:text/html;charset=utf-8');
        $category = new Categories();
        $result = $category->getCategoriesList(['id'=>16,'level'=>2]);
        //{id:4, pId:0, name:"河北省", open:true},
        foreach ($result as $c) {
            $arr['id'] = $c->id;
            $arr['pId'] = $c->pid;
            $arr['name'] = $c->title;
            if ($arr->level == 1) {
                $arr['open'] = true;
            }
            $res[] = $arr;
        }
        $res = json_encode($arr);
        var_dump($result);
        //foreach

    }

    /**
     * @deprecated 获取类列表
     * @param $args
     * @return array
     * @since 2016-03-12
     */
    private function _getCategoryList($args = array())
    {
        $result = [];
        $category = new Categories();
        $categories = $category->getCategoriesList($args);
        if ($categories) {
            foreach ($categories as $c) {
                $arr['id'] = $c->id;
                $arr['pId'] = $c->pid;
                $arr['name'] = $c->title;
                $result[] = $arr;
            }
        }
        return $result;
    }
}