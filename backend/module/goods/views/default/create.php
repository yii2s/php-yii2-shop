<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Goods */

$this->title = '新建商品';
$this->params['breadcrumbs'][] = ['label' => 'Goods', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-create">

    <!--<h3><?/*= Html::encode($this->title) */?></h3>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
