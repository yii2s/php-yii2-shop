<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/30
 * Time: 13:42
 */

namespace frontend\controllers;


use common\models\Goods;
use common\models\Task;
use common\service\DBService;
use common\utils\DebugUtil;
use Yii;
use common\components\CController;

class TestController extends CController
{
    public function actionSql()
    {
        $data = DBService::factory()->showTable(Goods::tableName());
        DebugUtil::format($data);
    }
}