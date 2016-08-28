<?php
namespace frontend\controllers;

use common\components\CController;
use common\config\Conf;
use common\models\Category;
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
        return $this->render('list', [
            'parentCats' => CategoryService::factory()->getParentCats(intval($_GET['cid']))
        ]);
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
        $sort   = (int)Yii::$app->request->post('sort');
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
        $args['order'] = $this->_getOrder($order, $sort);

        $return['list'] = GoodsService::factory()->getList($args);
        ResponseUtil::json(['data' => $return]);
    }

    /**
     * @brief 分类导航
     * @param $cid
     * @return string
     * @since 2016-08-28
     */
    public function actionCats($cid)
    {
        return $this->render('cats', ['cid' => $cid]);
    }

    public function actionDetail()
    {
        $id = (int)Yii::$app->request->get('id');
        $data = GoodsService::factory()->detail($id);
        print_r($data);
    }

    public function actionTest()
    {
        $dirPath = Yii::getAlias('@common') . DIRECTORY_SEPARATOR . 'data'. DIRECTORY_SEPARATOR . 'goods';
        $file = FileUtil::readDirFile($dirPath);
        ImageUtil::watermark($file[1], [320,180], $file[0]);
        //echo FileUtil::suffix($file);
    }

    /**
     * @brief 排序
     * @param string $order 排序标识
     * @param int $sort 正序或倒序
     * @return array
     * @author wuzhc 2016-08-16
     */
    private function _getOrder($order, $sort = SORT_DESC)
    {
        if ($order == 'sale') {
            return ['t.sale' => $sort];
        } elseif ($order == 'comment') {
            return ['t.comments' => $sort];
        } elseif ($order == 'price') {
            return ['t.sell_price' => $sort];
        } else {
            return ['t.id' => $sort];
        }
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

		$cid = $cid ?: 4;
        $attr = CategoryService::factory()->getAttrValByCid($cid);
        ResponseUtil::json(['data' => $attr]);
    }

    /**
     * @brief 商品推荐
     * @param $cid
     * @author wuzhc 2016-08-16
     */
    public function actionRecommendGoods($cid = 4)
    {
        $args = [
            'cid' => $cid,
            'limit' => 11,
            'commend_id' => Conf::GOODS_RECOMMEND
        ];
        $data = GoodsService::factory()->getCommendGoods($args);
        ResponseUtil::json(['data' => $data]);
    }

    public function actionT()
    {
        $parentCats= CategoryService::factory()->getParentCats(609);
        print_r($parentCats);
    }
}
