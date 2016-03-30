<?php
namespace backend\controllers;

use backend\form\AddAttributeForm;
use common\models\Attribute;
use common\models\Categories;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use backend\form\LoginForm;

class AttributesController extends Controller
{

    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * 添加属性
     * @since 2016-03-12
     */
    public function actionAdd()
    {

        $model = new AddAttributeForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->addAttributes()) {
                $this->success();
            } else {
                $this->error();
            }
        } else {
            $categories = new Categories();
            $lists = $categories->getListJson();
            return $this->render('add',[
                'model' => $model,
                'lists' => $lists,
            ]);
        }


        if (Yii::$app->request->isPost) {
            $data = $_POST;
            if (!$data['pid']) {
                $this->error('请选择父类');
            }
            if (!$data['title']) {
                $this->error('类名不能为空');
            }
            if ($categories->addCategory($data)) {
                //$this->success('添加成功');
                $this->redirect(['categories/add']);
            } else {
                $this->error('添加失败');
            }
        } else {
            $lists = $categories->getListJson();
            return $this->render('add',[
                'lists' => $lists,
            ]);
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