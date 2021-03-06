<?php

namespace backend\controllers;


use common\hybrid\AbstractHybrid;
use common\models\Goods;
use common\service\DBService;
use common\service\SystemService;
use common\utils\DebugUtil;
use Yii;
use common\service\GoodsService;
use yii\web\Controller;

class SystemController extends Controller
{
    public function goodsNum()
    {
        $data = GoodsService::factory()->statByCategoryID();
        print_r($data);
    }

    public function actionInfo()
    {
        $data['os'] = PHP_OS;
        $data['php'] = PHP_VERSION;
        $data['curTime'] = date('Y-m-d H:i:s', time());
        $data['memoryLimit'] = get_cfg_var('memory_limit');
        $data['uploadMaxSize'] = get_cfg_var('upload_max_filesize');
        print_r($data);
    }

    public function actionTest()
    {
        //首先主库添加具有赋值权限的用户
        $h = new AbstractHybrid();
        $data = $h->save('goods',['id'=>'888','sdf'=>44,'ooo' =>'ee'],['id' => 609]);
        DebugUtil::format($data);
    }


}