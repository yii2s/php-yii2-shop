<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Category */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-view">

    <p>
        <?= Html::a('编辑', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '你确定要删除吗?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'template' => '<tr><th class="col-sm-2">{label}</th><td class="col-sm-10">{value}</td></tr>',
        'attributes' => [
            'id',
            'name',
            [
                'attribute' => 'parent_id',
                'value' => \common\models\Category::findOne($model->parent_id)->name ?: '第一级大类'
            ],
            'sort',
            [
                'attribute' => 'visibility',
                'value' => $model->visibility == 0 ? '是' : '否'
            ],
            'keywords',
            'descript',
            'title',
            'seller_id',
        ],
    ]) ?>

</div>
