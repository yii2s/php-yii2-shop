<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\module\goods\models\GoodsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Goods';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-index">

    <!--<h1><?/*= Html::encode($this->title) */?></h1>-->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新建商品', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box box-primary">

        <div class="box-header">
            <h3 class="box-title">Data Table With Full Features</h3>
        </div>

        <div class="box-body">
    <?php Pjax::begin(); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'cid',
                'name',
                'goods_no',
                'model_id',
                'sell_price',
                // 'market_price',
                // 'cost_price',
                // 'up_time',
                // 'down_time',
                'create_time',
                // 'store_nums',
                // 'img',
                // 'ad_img',
                // 'is_del',
                   'content:ntext',
                // 'keywords',
                // 'description',
                // 'search_words',
                // 'weight',
                // 'point',
                // 'unit',
                   'brand_id',
                   'visit',
                   'favorite',
                   'sort',
                // 'spec_array:ntext',
                // 'exp',
                   'comments',
                // 'sale',
                // 'grade',
                // 'seller_id',
                // 'is_share',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    <?php Pjax::end(); ?>

        </div>
</div>
