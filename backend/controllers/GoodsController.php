<?php
namespace backend\controllers;

use common\service\GoodsService;
use common\utils\ResponseUtil;
use Yii;
use yii\web\Controller;

class GoodsController extends Controller
{
    public $enableCsrfValidation = false;

    public function actionAdd()
    {
        if ($data = Yii::$app->request->post())
        {
            list($status, $msg) = GoodsService::factory()->save($data)
                ? [0, '操作成功'] : [1, '操作失败'];
            ResponseUtil::json(null, $status, $msg);
        }
        else
        {
            return $this->render('add');
        }

    }

    public function actionList()
    {
        return $this->render('list');
    }
}