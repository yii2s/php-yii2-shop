<?php
namespace frontend\controllers;

use common\components\CController;
use common\models\Goods;
use common\models\GoodsAttrValMap;
use common\service\CategoryService;
use common\service\GoodsService;
use common\utils\FileUtil;
use common\utils\ImageUtil;
use common\utils\ResponseUtil;
use Yii;
use yii\web\Controller;


/**
 * Goods controller
 */
class GoodsController extends CController
{
    public function actionList()
    {
        return $this->render('list');
    }

    /**
     * @brief ajax获取商品列表
     * @author wuzhc 2016-08-14
     */
    public function actionAjaxList()
    {
        $return = [];

        $cid    = Yii::$app->request->post('cid',4);
        $vid    = (array)Yii::$app->request->post('vid');
        $vid    = array_map('intval', $vid);
        $word   = Yii::$app->request->post('word');
        $order  = Yii::$app->request->post('order');
        $limit  = Yii::$app->request->post('pageSize', 48);
        $limit  = $limit > 48 ? 48 : intval($limit);
        $offset = Yii::$app->request->post('page', 0);

        $args = [
            'cid' => intval($cid),
            'vid' => array_filter($vid),
            'keyword' => trim($word),
            'asArray' => true,
            'select' => ['t.name', 't.id', 't.sell_price', 't.market_price', 't.ad_img'],
        ];

        $return['total'] = GoodsService::factory()->countGoods($args);//总数

        $args['limit'] = intval($limit);
        $args['offset'] = intval($offset);
        $args['order'] = $this->_getOrder($order);

        $return['list'] = GoodsService::factory()->getList($args);
        ResponseUtil::json(['data' => $return]);
    }

    public function actionDetail()
    {

    }

    public function actionTest()
    {
        $dirPath = Yii::getAlias('@common') . DIRECTORY_SEPARATOR . 'data'. DIRECTORY_SEPARATOR . 'goods';
        $file = FileUtil::readDirFile($dirPath);
        ImageUtil::watermark($file[1], [320,180], $file[0]);
        //echo FileUtil::suffix($file);
    }

    private function _getOrder($order)
    {

    }

    /**
     * @brief 根据分类ID获取对应属性和属性值
     * @param int $cid 分类ID
     * @author wuzhc 2016-08-10
     */
    public function actionGetAttrValByCid($cid = 4)
    {
        $this->checkAjaxRequest();

        if (!is_numeric($cid)) {
            ResponseUtil::json(null, 1, '参数错误');
        }

        $attr = CategoryService::factory()->getAttrValByCid($cid);
        ResponseUtil::json(['data' => $attr]);
    }
}
