<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/14
 * Time: 23:26
 */

namespace console\controllers;


use common\hybrid\GoodsHybrid;
use common\models\CommentGoods;
use common\models\GoodsAttrValMap;
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

        while (True) {
            $task = Task::find()->where(['status' => 0])->one();
            if (empty($task)) {
                echo 'all data has inserted';
                break;
            }

            $args['goods_no'] = 'k' . rand(9999,1000000);
            $args['name'] = $task->title;
            $args['sell_price'] = floatval($task->price);
            $args['market_price'] = floatval($task->price) + 23;
            $args['cost_price'] = floatval($task->price) * 0.4;
            $args['ad_img'] = $task->thumb;
            $args['img'] = $task->thumb;
            $args['content'] = $task->title;
            $args['is_del'] = 3;
            $args['weight'] = rand(5,300);
            $args['cid'] = rand(3,4);
            $args['up_time'] = date('Y-m-d H:i:s', time());
            $result = $hybrid->save($args);

            //记录添加行为1成功，2失败
            $result ? $task->status = 1 : $task->status = 2;
            $task->save();

            //保存属性值关系
            $goodsAttr = new GoodsAttrValMap();
            $goodsAttr->vid = rand(1, 25);
            $goodsAttr->aid = 1;
            $goodsAttr->gid = $result;
            $goodsAttr->save();

            $goodsAttr = new GoodsAttrValMap();
            $goodsAttr->vid = rand(1036, 1037);
            $goodsAttr->aid = 9;
            $goodsAttr->gid = $result;
            $goodsAttr->save();

            $goodsAttr = new GoodsAttrValMap();
            $goodsAttr->vid = rand(1024, 1035);
            $goodsAttr->aid = 10;
            $goodsAttr->gid = $result;
            $goodsAttr->save();

            $goodsAttr = new GoodsAttrValMap();
            $goodsAttr->vid = rand(1021, 1023);
            $goodsAttr->aid = 2;
            $goodsAttr->gid = $result;
            $goodsAttr->save();

            //推荐商品
            $commend = new CommentGoods();
            $commend->goods_id = $result;
            $commend->commend_id = rand(1,4);
            $commend->save();


            $title = '('.$result.') ' . iconv('UTF-8','GBK',$task->title);
            echo $result ? $title . ' success' : $title . ' fail';
            echo PHP_EOL . PHP_EOL;
        }
    }

    /**
     * @brief 读取sql文件
     * @author wuzhc 2016-08-15
     */
    public function actionReadSql()
    {
        $dirPath = Yii::getAlias('@common') . DIRECTORY_SEPARATOR . 'data'. DIRECTORY_SEPARATOR . 'goods/drink';
        $sqlFiles = FileUtil::readDirFile($dirPath);

        $row = 1;
        foreach ($sqlFiles as $file) {
            if (!is_file($file)) {
                echo $file . 'is not a file' . PHP_EOL;
                continue;
            }
            if (stripos(basename($file), '_lock') !== false) {
                continue;
            }
            $handle = fopen($file, "r");
            if (!$handle) {
                echo $file . 'open file fail' . PHP_EOL;
                continue;
            }
            $i = 0;
            while (($sql = fgets($handle)) !== false) {

                //跳过第一行
                $i++;
                if ($i == 1) {
                    continue;
                }

                $row++;
                $sql = str_ireplace('task_18689', 'zc_task', $sql);
                $result = Yii::$app->db->createCommand($sql)->execute();
                echo $result > 0 ? $row . ' success' : $row . ' fail';
                echo PHP_EOL;
            }
            if (!feof($handle)) {
                echo "Error: unexpected fgets() fail" . PHP_EOL;
            }
            fclose($handle);

            //锁定文件
            FileUtil::addFlag($file, '_lock');
        }
    }
}