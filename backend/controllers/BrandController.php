<?php
namespace backend\controllers;

use backend\form\AddBrandForm;
use backend\form\UploadForm;
use common\models\Brand;
use common\models\Categories;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use backend\form\LoginForm;

class BrandController extends Controller
{

    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * 添加品牌
     * @since 2016-03-12
     */
    public function actionAdd()
    {
        $model = new AddBrandForm();
        if ($model->load(Yii::$app->request->post())) {
            $model->logo = UploadedFile::getInstance($model, 'logo');
            if ($model->upload()) {
                if ($model->addBrand()) {
                    return $this->refresh();
                }
            }
            $this->error('添加失败');
        } else {
            $categories = new Categories();
            $categoryLists = $categories->getCategoriesList([
                'level' => 3,
                'select' => 'id,title',
            ]);
            if (is_array($categoryLists)) {
                foreach ($categoryLists as $item) {
                    $arr[$item->id] = $item->title;
                }
            }
            return $this->render('add',[
                'categoryLists' => $arr ?: [],
                'brandLists' => $this->_getList(),
                'model' => $model,
            ]);
        }
    }

    public function _getList()
    {
       return Brand::find()->all();
    }

    /**
     * 删除单个
     * @since 2016-03-12
     */
    public function actionDelete()
    {
        $id = (int)Yii::$app->request->get('id');
        $brand = new Brand();
        if ($brand->deleteBrand($id)) {
            $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }

    }

    /**
     * 批量删除
     * @since 2016-03-13
     */
    public function actionBatchDelete()
    {
        $id = (int)Yii::$app->request->get('id');
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

    public function actionUpload()
    {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');

        if ($model->file && $model->validate()) {
            $model->file->saveAs('uploads/' . $model->file->baseName . '.' . $model->file->extension);
        }
    }

        return $this->render('upload', ['model' => $model]);
}

}