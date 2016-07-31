<?php
namespace backend\controllers;

use common\config\Conf;
use common\models\Categories;
use common\models\Category;
use common\service\CategoryService;
use common\utils\ResponseUtil;
use Yii;
use yii\web\Response;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\web\Controller;
use yii\filters\VerbFilter;
use backend\form\LoginForm;

class CategoryController extends Controller
{

    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * @brief 添加类别
     * @author wuzhc 2016-07-31
     */
    public function actionAdd()
    {
        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();
            list($status, $msg) = CategoryService::factory()->save($data)
                ? array(0, '保存成功') : array(1, '保存失败');
            ResponseUtil::json(null, $status, $msg);
        } else {
            return $this->render('add', [
                'categories' => CategoryService::factory()->getCategoriesMap()
            ]);
        }
    }

    /**
     * @brief 获取子类
     * @throws \yii\base\ExitException
     * @author wuzhc 2016-07-31
     */
    public function actionGetChildren()
    {
        if (!Yii::$app->request->isAjax) {
            Yii::$app->end('Invalid Request');
        }

        $parentID = Yii::$app->request->get('parentID');
        if (is_numeric($parentID)) {
            ResponseUtil::json(['list' => CategoryService::factory()->getChildren($parentID)]);
        } else {
            ResponseUtil::json(null, 1, '参数错误');
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
    }

    /**
     * 删除分类
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

    public function actionList()
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
     * 获取类列表
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