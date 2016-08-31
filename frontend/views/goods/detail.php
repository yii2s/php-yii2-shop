<?php
use common\widgets\MagnifierWidget;
use yii\bootstrap\Html;

$this->params['breadcrumbs'][] = '商品详情页';

?>
<?= Html::cssFile('public/frontend/css/base.css'); ?>
<?= Html::cssFile('public/frontend/css/site.css'); ?>
<style>
    .body-content{
        border: 1px solid #DDDDDD;
        padding: 5px 20px;
    }
    a {
        color: #454545;
        text-decoration: none;
    }
    #name {
        line-height: 1.5em;
        overflow: hidden;
        font-weight: 700;
        font-family: arial,"microsoft yahei";
        font-size: 16px;
    }
</style>
<div class="site-index">

    <div class="body-content">
        <div class="" style="width:1220px;margin-top: 10px;margin-left: auto;margin-right: auto;">
            <div class="" style="width: 350px;float: left;margin-right: 20px;">
                <?= MagnifierWidget::Widget(['imgUrls' => $images]);?>
            </div>
            <div class="" style="width: 600px;float: left;margin-right: 10px">
                <div id="name">好视力 美式 落地灯 客厅卧室书房现卧室书房现代简约工作阅读LED铁艺落地台灯TG835-WH</div>
                市场价：100，现价：99
            </div>
            <div class="" style="width: 230px;float: left">
                商家信息
            </div>
        </div>
        <div class="row" style="clear: both">
            <div class="col-lg-3">推荐商品</div>
            <div class="col-lg-9">
                <div class="row">商品属性</div>
                <div class="row">商品描述</div>
            </div>
        </div>
    </div>
</div>



<?php $this->beginBlock('jquery') ?>

$(function() {


});

<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['jquery'], \yii\web\View::POS_END); ?>



