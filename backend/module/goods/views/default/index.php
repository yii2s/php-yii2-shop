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
            <h3 class="box-title">商品列表</h3>
        </div>

        <div class="box-body">
    <?php Pjax::begin(); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'id',
                [
                    'attribute' => 'name',
                    'label' => '标题',
                    'headerOptions' => ['width' => '300'],
                ],
                [
                    'attribute' => 'goods_no',
                    'label' => '商品号',
                    'headerOptions' => ['width' => '100'],
                ],
                //'model_id',
                [
                    'attribute' => 'sell_price',
                    'label' => '销售价格',
                    'headerOptions' => ['width' => '80'],
                ],
                // 'market_price',
                // 'cost_price',
                // 'up_time',
                // 'down_time',
                [
                    'attribute' => 'create_time',
                    'label' => '创建时间',
                    'headerOptions' => ['width' => '150'],
                ],
                [
                    'attribute' => 'store_nums',
                    'label' => '库存',
                    'headerOptions' => ['width' => '80'],
                ],
                // 'img',
                // 'ad_img',
                // 'is_del',
                // 'content:ntext',
                // 'keywords',
                // 'description',
                // 'search_words',
                // 'weight',
                // 'point',
                // 'unit',
                [
                    'attribute' => 'category_id',
                    'label' => '分类',
                    'value' => function($searchModel) {
                        return $searchModel->category->name;
                    },
                    'headerOptions' => ['width' => '100'],
                ],
                //'category_id',
                [
                    'attribute' => 'visit',
                    'label' => '游览量',
                    'headerOptions' => ['width' => '80'],
                ],
                [
                    'attribute' => 'favorite',
                    'label' => '收藏数',
                    'headerOptions' => ['width' => '80'],
                ],
                //'sort',
                // 'spec_array:ntext',
                // 'exp',
                [
                    'attribute' => 'comments',
                    'label' => '评论数',
                    'headerOptions' => ['width' => '80'],
                ],
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
