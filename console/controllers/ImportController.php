<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/14
 * Time: 23:26
 */

namespace console\controllers;


use common\hybrid\GoodsHybrid;
use common\models\Task;
use common\utils\FileUtil;
use Yii;
use yii\console\Controller;


class ImportController extends Controller
{
    /**
     * @brief 添加商品测试数据
     * @author wuzhc 2016-08-15
     */
    public function actionAddGoods()
    {
        error_reporting(0);
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
            echo $hybrid->save($args) ? $hybrid->id . ' success' : $hybrid->id . ' fail';
            echo PHP_EOL;
        }
    }

    /**
     * @brief 读取sql文件
     * @author wuzhc 2016-08-15
     */
    public function actionReadSql()
    {
        $dirPath = Yii::getAlias('@common') . DIRECTORY_SEPARATOR . 'data'. DIRECTORY_SEPARATOR . 'goods';
        $sqlFiles = FileUtil::readDirFile($dirPath);

        $j = 0;
        foreach ($sqlFiles as $file) {
            if (!is_file($file)) {
                echo $file . 'is not a file' . PHP_EOL;
                continue;
            }
            $handle = fopen($file, "r");
            if (!$handle) {
                echo $file . 'open file fail' . PHP_EOL;
                continue;
            }
            $i = 0;
            while (($sql = fgets($handle)) !== false) {
                $i++;
                $j++;

                //跳过第一行
                if ($i == 1) {
                    continue;
                }

                $sql = str_ireplace('task_18689', 'task', $sql);
                $result = Yii::$app->db->createCommand($sql)->execute();
                echo $result > 0 ? $j . ' success' : $j . ' fail';
                echo PHP_EOL;
            }
            if (!feof($handle)) {
                echo "Error: unexpected fgets() fail" . PHP_EOL;
            }
            fclose($handle);
        }
    }
}