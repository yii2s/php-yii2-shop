<?php

namespace backend\controllers;


use common\utils\ExcelUtil;
use common\utils\ResponseUtil;
use Yii;
use common\utils\FileUtil;
use yii\web\Controller;

class AttrController extends Controller
{
    public $enableCsrfValidation = false;

    public function actionAdd()
    {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if ($data['fileUrl']) {
                $data = ExcelUtil::read($data['fileUrl']);
            }
        }
        return $this->render('add');
    }

    public function actionAddValue()
    {

    }

    public function actionList()
    {

    }

    public function actionUpload()
    {
        $field = Yii::$app->request->get('field', 'Filedata');
        $url = FileUtil::upload($field,'',['xls','xlsx','png']);
        ResponseUtil::json(['url' => $url]);
    }
}