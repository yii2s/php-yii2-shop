<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Goods */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Goods', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'cid',
            'name',
            'goods_no',
            'model_id',
            'sell_price',
            'market_price',
            'cost_price',
            'up_time',
            'down_time',
            'create_time',
            'store_nums',
            'img',
            'ad_img',
            'is_del',
            'content:ntext',
            'keywords',
            'description',
            'search_words',
            'weight',
            'point',
            'unit',
            'brand_id',
            'visit',
            'favorite',
            'sort',
            'spec_array:ntext',
            'exp',
            'comments',
            'sale',
            'grade',
            'seller_id',
            'is_share',
        ],
    ]) ?>

</div>
