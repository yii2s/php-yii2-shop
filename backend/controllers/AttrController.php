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
        if (Yii::$app->request->isAjax) {
            $attrVal = AttrValue::find();
            $attrID = (int)Yii::$app->request->post('attrID');
            if ($attrID) {
                $attrVal->where(['aid' => $attrID]);
            }
            $data['rows'] = $attrVal
                ->offset(intval($_POST['start']))
                ->limit(intval($_POST['limit']))
                ->orderBy(['id' => SORT_DESC, 'sort' => SORT_ASC])
                ->asArray()
                ->all();
            $data['results'] = $attrVal->count();
            $data['hasError'] = false;
            $data['error'] = '';
            echo Json::encode($data);exit;
        }

        return $this->render('listAttrVal', [
            'attrs' => Attr::find()->all()
        ]);
    }

    /**
     * @brief 增加或修改单个属性值
     * @author wuzhc 2016-08-04
     */
    public function actionAddOneAttrVal()
    {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $data['aid'] = $data['attrID'];
            list($status, $msg) = CategoryService::factory()->addAttrValue($data)
                ? [0, '操作成功'] : [1, '操作失败'];
            ResponseUtil::json(null, $status, $msg);
        }
    }

    /**
     * @brief 添加属性值
     * @return string
     * @author wuzhc 2016-08-03
     */
    public function actionAddAttrVal()
    {
        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();
            $attr = array_map('intval', $data['attr']);
            $value = explode(',', str_replace('，', ',', $data['value']));

            $args = [];
            foreach ($attr as $a) {
                foreach ($value as $v) {
                    $args[] = [$a, $v]; //[属性ID, 属性值]
                }
            }
            list($status, $msg) = CategoryService::factory()->batchAddAttrValue($args)
                ? [0, '操作成功'] : [1, '操作失败'];
            ResponseUtil::json(null, $status, $msg);
        }
        else
        {
            $attrs = Attr::find()->all();
            return $this->render('addAttrVal', ['attrs' => $attrs]);
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