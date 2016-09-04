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
    p {margin: 3px 0px;}
    .btn-default:active, .btn-default.active, .btn-default.active.focus, .btn-default.active:hover{
        color: #ffffff;
        background-color: #e3393c;
    }
</style>
<div class="site-index">

    <div class="body-content">
        <div class="" style="width:1220px;margin-top: 10px;margin-left: auto;margin-right: auto;">
            <div class="" style="width: 350px;float: left;margin-right: 20px;">
                <?= MagnifierWidget::Widget(['imgUrls' => $data['photos']]);?>
            </div>
            <div class="" style="width: 600px;float: left;margin-right: 10px">

                <h4><strong><?= $data['name']?></strong></h4>
                <p style="color: #e3393c;line-height: 20px;word-break: break-all;font-family: arial,microsoft yahei">请选择适合自己的套餐购买，标准版为普通导航（无3G无蓝牙）旗舰版（有3G和蓝牙功能） 推荐</p>

                <div style="background-color: #f7f7f7;line-height: 50px;height: 50px; padding-right: 10px">
                     <div style="float: left">优惠价：<span style="color: #E4393C;font-size: 24px;margin-right: 10px;font-weight: bold">¥<?= $data['sellPrice']?></span>
                         <small><del>市场价：¥<?= $data['marketPrice']?></del></small>
                     </div>
                    <div style="float: right">累计评论：<span style="color: #005ea7;font-weight: bold">1540002</span></div>
                </div>

                <div style="clear: both;margin-top: 15px">
                    <p style="color: #666666">配送至：北京朝阳区管庄<span style="font-size: 16px;font-weight: bold">有货</span>，支持 货到付款免运费</p>
                    <p>服务：<span style="font-size: 12px;color: #666666">由四春汽车用品专营店从 广东深圳市 发货，并提供售后服务。</span></p>
                </div>

                <?php if ($data['spec']) { ?>
                <div class="panel panel-danger">
                    <div class="panel-body">
                        <?php foreach ($data['spec'] as $spec) { ?>
                        <div style="margin-top: 5px; height: 40px">
                            <div style="width: 70px;float: left; text-align: right; line-height: 40px">
                                <?= $spec->name; ?>：
                            </div>
                            <div class="btn-group" data-toggle="buttons" style="float: left;width: 450px">
                                <?php foreach ((array)$spec->children as $specOption) { ?>
                                    <?php if ($spec->type == 2) { ?>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="spec-select" value="<?=$specOption?>"> <img src="<?=$specOption?>" width="40" height="40">
                                        </label>
                                    <?php } else { ?>
                                        <label class="btn btn-default" style="margin-right: 5px;margin-bottom: 5px;">
                                            <input type="radio" name="options" id="option1" value="<?= $specOption?>"> <?= $specOption?>
                                        </label>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                        <?php } ?>
                        <!--<div style="margin-top: 5px; height: 40px">
                            <div style="width: 70px;float: left; text-align: right; line-height: 40px">
                                颜色：
                            </div>
                            <div class="btn-group" data-toggle="buttons" style="float: left">
                                <label class="btn btn-primary">
                                    <input type="radio" name="options" id="option1"> 选项 1
                                </label>
                                <label class="btn btn-primary">
                                    <input type="radio" name="options" id="option2"> 选项 2
                                </label>
                                <label class="btn btn-primary">
                                    <input type="radio" name="options" id="option3"> 选项 3
                                </label>
                            </div>
                        </div>-->
                    </div>
                </div>
                <?php } ?>
                <div style="clear: both">
                    <button type="button" class="btn btn-lg" style="background-color: #ffffff;border: 1px solid #8c8c8c"
                            data-toggle="button"><span class="glyphicon glyphicon-shopping-cart">加入购物车</span>
                    </button>
                    <button type="button" class="btn btn-danger btn-lg"
                            data-toggle="button"> <span class="glyphicon glyphicon-heart">立即购买</span>
                    </button>
                </div>

            </div>
            <div class="" style="width: 230px;float: left">
                商家信息
            </div>
        </div>
        <div class="row"></div>
        <div class="row" style="clear: both; margin-top: 20px">
            <div class="col-lg-3">推荐商品</div>
            <div class="col-lg-9">
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading">面板标题</div>
                        <div class="panel-body">
                            <p>这是一个基本的面板内容。这是一个基本的面板内容。
                                这是一个基本的面板内容。这是一个基本的面板内容。
                                这是一个基本的面板内容。这是一个基本的面板内容。
                                这是一个基本的面板内容。这是一个基本的面板内容。
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading">商品描述</div>
                        <div class="panel-body">
                            <?= $data['content']?>
                        </div>
                    </div>

            </div>
        </div>
    </div>
</div>



<?php $this->beginBlock('jquery') ?>

$(function() {


});

<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['jquery'], \yii\web\View::POS_END); ?>



