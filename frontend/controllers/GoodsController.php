<?php
namespace frontend\controllers;

use Yii;
use common\components\CController;
use common\config\Conf;
use common\service\CategoryService;
use common\service\GoodsService;
use common\utils\FileUtil;
use common\utils\ImageUtil;
use common\utils\ResponseUtil;


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
     * @since 2016-08-14
     */
    public function actionAjaxList()
    {
        $return = [];

        $cid = $this->getParam('cid', 4);
        $word = $this->getParam('word', null, 'trim');
        $order = $this->getParam('order');
        $sort = $this->getParam('sort');
        $offset = $this->getParam('page', 0, 'intval');
        $vid = (array)$this->getParam('vid', null, function($vid){
            return intval($vid);
        });
        $limit = $this->getParam('pageSize', null, function($limit) {
            return $limit > 48 ? 48 : intval($limit);
        });

        $args = [
            'cid' => $cid,
            'vid' => array_filter($vid),
            'keyword' => $word,
            'asArray' => true,
            'select' => ['t.name', 't.id', 't.sell_price', 't.market_price', 't.ad_img'],
        ];

        $return['total'] = GoodsService::factory()->countGoods($args);//总数

        $args['limit'] = $limit;
        $args['offset'] = $offset;
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

    /**
     * 商品详情
     * @return string
     * @throws \yii\base\ExitException
     * @since 2016-10-19
     */
    public function actionDetail()
    {
        $id = $this->getParam('id', 8834, 'intval');
        if (empty($id)) {
            Yii::$app->end('参数错误！');
        }

        return $this->render('detail', [
            'data' => GoodsService::factory()->detail($id)
        ]);
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
     * @since 2016-08-16
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
     * @since 2016-08-10
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
     * @since 2016-08-16
     */
    public function actionRecommendGoods()
    {
        $data = [];
        $cid = $this->getParam('cid', null, 'intval');
        if (!$cid) {
            ResponseUtil::json(['data' => $data]);
        }

        $data = GoodsService::factory()->getCommendGoods([
            'cid' => $cid,
            'limit' => 11,
            'commend_id' => Conf::GOODS_RECOMMEND
        ]);
        ResponseUtil::json(['data' => $data]);
    }

    public function actionT()
    {
        $data = Yii::$app->mongo->findOne('goods', ['id' => 8837]);
        print_r($data);
    }

    /**
     * 搜索引擎
     * @since 2016-10-11
     */
    public function actionSearch()
    {
        $this->layout = '';

        $keyword = $this->getParam('keyword',null,'trim');
        if (!$keyword) {
            ResponseUtil::json(null);
        }

        $data = Yii::$app->sphinx
            ->index('goods')
            ->limit(10)
            ->offset(0)
            ->query($keyword);

        ResponseUtil::json($data);
    }
}
