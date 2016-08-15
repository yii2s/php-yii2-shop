<?php
namespace frontend\controllers;

use common\models\Goods;
use common\models\GoodsAttrValMap;
use common\service\GoodsService;
use common\utils\ResponseUtil;
use Yii;
use yii\web\Controller;


/**
 * Goods controller
 */
class GoodsController extends Controller
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

        $cid    = Yii::$app->request->get('cid',4);
        $vid    = Yii::$app->request->get('vid','0');
        $vid    = array_map('intval', explode('-', $vid));
        $word   = Yii::$app->request->get('word');
        $order  = Yii::$app->request->get('order');
        $limit  = Yii::$app->request->get('pageSize', 48);
        $limit  = $limit > 48 ? 48 : intval($limit);
        $offset = Yii::$app->request->get('page', 0);

        $args = [
            'cid' => intval($cid),
            'vid' => array_filter($vid),
            'keyword' => trim($word),
            'select' => ['t.name', 't.id', 't.sell_price', 't.market_price', 't.ad_img'],
            'asArray' => true,
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
        $data = GoodsAttrValMap::find()->andWhere(['vid'=>1022])->andWhere(['vid'=>29])->andWhere(['ds'=>1])->asArray()->all();
        print_r($data);
    }

    private function _getOrder($order)
    {
    }
}
