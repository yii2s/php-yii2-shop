<?php

namespace common\utils;

use Yii;
use yii\helpers\Json;

class ResponseUtil
{

    public static function json($data = null, $status = 0, $msg = '操作成功')
    {
        $data['status'] or $data['status'] = $status;
        $data['msg'] or $data['msg'] = $msg;
        echo Json::encode($data);
        Yii::$app->end();
    }

}