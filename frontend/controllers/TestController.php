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

    public function actionMongo()
    {
        $data = Yii::$app->mongo->specialFind('goods', [], ['limit' => 2, 'sort' => ['id'=>-1], 'select' => ['name' => 1, '_id' => 0]],['$maxscan'=>3]);
        //$data = Yii::$app->mongo->command();
        print_r($data);
    }

    public function actionEvent()
    {
        //$this->on('111', 'hello', 'this is a event');
        $this->trigger('111');
    }

    public function actionSession()
    {
        Yii::$app->session['hehe'] = 'jaja';
        $session = Yii::$app->getSession();
        print_r($session->getIsActive());
    }
}