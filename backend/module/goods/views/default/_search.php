<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\module\goods\models\GoodsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="goods-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'cid') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'goods_no') ?>

    <?= $form->field($model, 'model_id') ?>

    <?php // echo $form->field($model, 'sell_price') ?>

    <?php // echo $form->field($model, 'market_price') ?>

    <?php // echo $form->field($model, 'cost_price') ?>

    <?php // echo $form->field($model, 'up_time') ?>

    <?php // echo $form->field($model, 'down_time') ?>

    <?php // echo $form->field($model, 'create_time') ?>

    <?php // echo $form->field($model, 'store_nums') ?>

    <?php // echo $form->field($model, 'img') ?>

    <?php // echo $form->field($model, 'ad_img') ?>

    <?php // echo $form->field($model, 'is_del') ?>

    <?php // echo $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'keywords') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'search_words') ?>

    <?php // echo $form->field($model, 'weight') ?>

    <?php // echo $form->field($model, 'point') ?>

    <?php // echo $form->field($model, 'unit') ?>

    <?php // echo $form->field($model, 'brand_id') ?>

    <?php // echo $form->field($model, 'visit') ?>

    <?php // echo $form->field($model, 'favorite') ?>

    <?php // echo $form->field($model, 'sort') ?>

    <?php // echo $form->field($model, 'spec_array') ?>

    <?php // echo $form->field($model, 'exp') ?>

    <?php // echo $form->field($model, 'comments') ?>

    <?php // echo $form->field($model, 'sale') ?>

    <?php // echo $form->field($model, 'grade') ?>

    <?php // echo $form->field($model, 'seller_id') ?>

    <?php // echo $form->field($model, 'is_share') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
