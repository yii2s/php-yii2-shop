<?php

namespace backend\controllers;


use common\models\Attr;
use common\models\AttrValue;
use common\service\CategoryService;
use common\utils\ExcelUtil;
use common\utils\ResponseUtil;
use Yii;
use common\utils\FileUtil;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\VarDumper;
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
                ? [0, '操作成功'] : [1, '操作失败'];
            ResponseUtil::json(null, $status, $msg);
        }
        else
        {
            list($status, $msg) = CategoryService::factory()->addAttr($data)
                ? [0, '操作成功'] : [1, '操作失败'];
            ResponseUtil::json(null, $status, $msg);
        }
    }

    /**
     * @brief 属性列表
     * @return string
     * @author wuzhc 2016-08-03
     */
    public function actionList()
    {
        if (Yii::$app->request->isAjax)
        {
            $data = Attr::find()->all();
            echo Json::encode($data);exit;
        }
        else
        {
            return $this->render('list');
        }
    }

    /**
     * @brief 属性值列表
     * @author wuzhc 2016-08-03
     */
    public function actionListAttrVal()
    {
        $attrVal = AttrValue::find();
        $attrID = (int)Yii::$app->request->get('attrID');
        if ($attrID) {
            $attrVal->where(['aid' => $attrID]);
        }
        $data = $attrVal->orderBy(['id' => SORT_DESC, 'sort' => SORT_ASC])->all();
        return $this->render('listAttrVal', ['data' => $data]);
    }

    /**
     * @brief 添加属性值
     * @return string
     * @author wuzhc 2016-08-03
     */
    public function actionAddAttrVal()
    {
        if (Yii::$app->request->isPost) {

        }
        else
        {
            return $this->render('addAttrVal');
        }
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