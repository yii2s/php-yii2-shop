<?php

namespace backend\controllers;


use common\service\CategoryService;
use common\utils\ExcelUtil;
use common\utils\ResponseUtil;
use Yii;
use common\utils\FileUtil;
use yii\web\Controller;

class AttrController extends Controller
{
    public $enableCsrfValidation = false;

    /**
     * @brief 渲染添加属性页面
     * @author wuzhc 2016-08-02
     */
    public function actionAdd()
    {
        return $this->render('add');
    }

    /**
     * @brief 保存属性
     * @author wuzhc 2016-08-02
     */
    public function actionSave()
    {
        $data = Yii::$app->request->post();
        if ($data['fileUrl'])  //文件导入
        {
            $url = iconv('utf-8', 'gbk//ignore', $data['fileUrl']);
            $attrData = ExcelUtil::read($url);
            array_shift($attrData['data']); //移除excel首行（即表头）数据
            list($status, $msg) = CategoryService::factory()->batchAddAttr($attrData['data'])
                ? [0, '添加成功'] : [1, '添加失败'];
            ResponseUtil::json(null, $status, $msg);
        }
        else
        {
            list($status, $msg) = CategoryService::factory()->addAttr($data)
                ? [0, '添加成功'] : [1, '添加失败'];
            ResponseUtil::json(null, $status, $msg);
        }
    }

    public function actionAddValue()
    {

    }

    public function actionList()
    {

    }

    /**
     * @brief 上传文件
     * @author wuzhc 2016-08-02
     */
    public function actionUpload()
    {
        $field = Yii::$app->request->get('field', 'Filedata');
        $url = FileUtil::upload($field,'',['xls','xlsx','png']);
        ResponseUtil::json(['url' => $url]);
    }
}