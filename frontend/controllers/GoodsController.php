<?php
namespace frontend\controllers;

use common\models\Goods;
use common\models\GoodsAttrValMap;
use common\service\GoodsService;
use Yii;
use yii\web\Controller;


/**
 * Goods controller
 */
class GoodsController extends Controller
{
    public function actionList()
    {
        $args = [
            //'cid'     => [3,4],
            'select'  => ['t.name','t.id'],
            'asArray' => true,
            //'keyword' => '属性值',
            'vid'     => [29,1022,3]
        ];
        $data = GoodsService::factory()->getList($args);
        print_r($data);
    }

    public function actionDetail()
    {

    }

    public function actionTest()
    {
        $data = GoodsAttrValMap::find()->andWhere(['vid'=>1022])->andWhere(['vid'=>29])->andWhere(['ds'=>1])->asArray()->all();
        print_r($data);
    }
}
