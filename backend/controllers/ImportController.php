<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/14
 * Time: 23:26
 */

namespace backend\controllers;


use common\hybrid\GoodsHybrid;
use common\models\Task;
use Yii;
use yii\web\Controller;

class ImportController extends Controller
{
    public function actionAddGoods()
    {
        set_time_limit(0);
        $hybrid = new GoodsHybrid();
        $data = Task::find()->asArray()->all();
        foreach ($data as $k=>$d) {
            $args['goods_no'] = 'k' . rand(9999,1000000);
            $args['name'] = $d['title'];
            $args['sell_price'] = $d['price'];
            $args['market_price'] = $d['price'] + 23;
            $args['cost_price'] = $d['price'] * 0.4;
            $args['ad_img'] = $d['thumb'];
            $args['img'] = $d['thumb'];
            $args['content'] = $d['title'];
            $args['is_del'] = 3;
            $args['up_time'] = date('Y-m-d H:i:s', time());
            echo $hybrid->save($args) ? 'success' : 'fail';
            echo '<br>';
        }
    }
}