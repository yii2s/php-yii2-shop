<?php
use common\widgets\MagnifierWidget;
use yii\bootstrap\Html;

$this->title = $data['name'];
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
    #photoPane{
        margin-bottom: 2px;
    }
    #thumbnailsPane{
        float: left;
    }
    #thumbnailsPane img{
        width: 55px;
        margin: 0;
    }
    .spec-on{background-color: darkseagreen;color: #ffffff;border: 1px solid #e3393c}
</style>
<div class="site-index">

    <div class="body-content">
        <div class="row" style="width:1220px;margin-top: 10px;margin-left: auto;margin-right: auto;padding-bottom:5px;border-bottom: 2px solid #DDDDDD">
            <div class="" style="width: 352px;float: left;margin-right: 20px;height: 425px;border: solid #DDDDDD 1px">
                <div id="photoPane">
                    <img src="public/common/images/buy1.jpg" id="photoDisplay" width="350" height="368">
                </div>
                <div id="thumbnailsPane">
                    <?php if ($data['photos']) { ?>
                        <?php foreach ($data['photos'] as $url) { ?>
                            <img src="<?= $url['s55']?>" alt="" width="55" height="55" onerror="this.src='public/common/images/1.jpg'">
                        <?php } ?>
                    <?php } else { ?>
                        <img src="public/common/images/buy1.jpg" alt="" width="55" height="55">
                        <img src="public/common/images/buy1.jpg" alt="" width="55" height="55">
                        <img src="public/common/images/buy1.jpg" alt="" width="55" height="55">
                        <img src="public/common/images/buy1.jpg" alt="" width="55" height="55">
                        <img src="public/common/images/buy1.jpg" alt="" width="55" height="55">
                        <img src="public/common/images/buy1.jpg" alt="" width="55" height="55">
                    <?php } ?>
                </div>
            </div>
            <div class="" style="width: 600px;float: left;margin-right: 10px">
                <h4><strong><?= $data['name']?></strong></h4>
                <p style="color: #e3393c;line-height: 20px;word-break: break-all;font-family: arial,microsoft yahei">请选择适合自己的套餐购买，标准版为普通导航（无3G无蓝牙）旗舰版（有3G和蓝牙功能） 推荐</p>
                <div style="background-color: #f7f7f7; height: 50px; width: 100%; padding-right: 10px">
                    <div style="float: left;height:50px;line-height:50px;width: 70%">优惠价：<span style="color: #E4393C;font-size: 24px;margin-right: 10px;font-weight: bold">¥<?= $data['sellPrice']?></span>
                        <small><del>市场价：¥<?= $data['marketPrice']?></del></small>
                    </div>
                    <div style="float: right;height:50px;line-height:50px;width: 30%"">累计评论：<span style="color: #005ea7;font-weight: bold"><?= $data['commentNum']?></span></div>
                </div>

                <div class="intro-item">
                    <div class="intro-item-name">
                        配送至：
                    </div>
                    <div style="float: left;width: 450px;line-height: 30px;color: #666666">
                        北京朝阳区管庄<span style="font-size: 16px;font-weight: bold">有货</span>，支持 货到付款免运费
                    </div>
                </div>
                <div class="intro-item">
                    <div class="intro-item-name">
                        服务：
                    </div>
                    <div style="float: left;width: 450px;line-height: 30px;color: #666666">
                        由四春汽车用品专营店从 广东深圳市 发货，并提供售后服务。
                    </div>
                </div>
                <?php if ($data['spec']) { ?>
                    <?php foreach ((array)$data['spec'] as $spec) { ?>
                        <?php if ($spec['type'] == 2) { ?>
                            <div class="intro-item spec-item" style="height: 50px">
                                <div class="intro-item-name">
                                    <?= $spec->name; ?>：
                                </div>
                                <div style="float: left;width: 450px">
                                    <?php foreach ((array)$spec['children'] as $specOption) { ?>
                                    <a class="select-spec" data-type="2" style="display:inline-block;cursor:pointer;margin-bottom: 5px;height: 50px;width: 50px">
                                        <img src="<?=$specOption?>" width="50" height="50">
                                    </a>
                                    <?php } ?>
                                    <a class="select-spec" data-type="2" style="display:inline-block;cursor:pointer;margin-bottom: 5px;height: 50px;width: 50px">
                                        <img src="uploads/tempFile/sdf_thumb_40_40.jpg" width="50" height="50">
                                    </a>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="intro-item spec-item">
                                <div class="intro-item-name">
                                    <?= $spec['name']; ?>：
                                </div>
                                <div style="float: left;width: 450px">
                                    <?php foreach ((array)$spec['children'] as $specOption) { ?>
                                        <span class="select-spec" data-type="1" style="cursor:pointer;margin-bottom: 5px;height: 30px;border: 1px solid #d0d0d0;line-height: 30px;margin-right: 5px;padding: 2px 5px">
                                            <?= $specOption?>
                                        </span>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
                <div class="intro-item">
                    <div class="intro-item-name">
                        数量：
                    </div>
                    <div style="float: left;width: 450px;line-height: 30px;color: #666666">
                        <input name="" type="text" value="0" size="2">
                    </div>
                </div>
                <div style="clear: both;margin-top: 20px">
                    <button type="button" class="btn btn-danger btn-lg"
                            data-toggle="button"><span class="glyphicon glyphicon-shopping-cart">加入购物车</span>
                    </button>
                    <button type="button" class="btn btn-danger btn-lg"
                            data-toggle="button"> <span class="glyphicon glyphicon-shopping-cart">立即购买</span>
                    </button>
                </div>

            </div>
            <div class="" style="width: 230px;float: left">
                <img src="public/common/images/buy.jpg">
            </div>
        </div>
        <div class="row"></div>
        <div class="row" style="clear: both; margin-top: 20px;width:1220px;margin-left: auto;margin-right: auto;" >
            <div class="col-lg-3">
                <div class="panel panel-default">
                    <div class="panel-heading">系统推荐</div>
                    <div class="panel-body">
                        <div>
                            <div class="thumbnail">
                                <img src="http://img20.360buyimg.com/vc/jfs/t2647/273/4133170162/92430/592b3bd4/57a93818N829cab72.jpg" alt="...">
                                <div class="caption">
                                    <h3 style="color: red">￥99.00</h3>
                                    <p><a>波司登男装2016青年时尚休闲短袖圆领T恤 圆领竹纤维半截袖体恤 1262Z13086 黄色 M</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div class="thumbnail">
                                <img src="http://img20.360buyimg.com/vc/jfs/t2647/273/4133170162/92430/592b3bd4/57a93818N829cab72.jpg" alt="...">
                                <div class="caption">
                                    <h3 style="color: red">￥99.00</h3>
                                    <p><a>波司登男装2016青年时尚休闲短袖圆领T恤 圆领竹纤维半截袖体恤 1262Z13086 黄色 M</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div class="thumbnail">
                                <img src="http://img20.360buyimg.com/vc/jfs/t2647/273/4133170162/92430/592b3bd4/57a93818N829cab72.jpg" alt="...">
                                <div class="caption">
                                    <h3 style="color: red">￥99.00</h3>
                                    <p><a>波司登男装2016青年时尚休闲短袖圆领T恤 圆领竹纤维半截袖体恤 1262Z13086 黄色 M</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div class="thumbnail">
                                <img src="http://img20.360buyimg.com/vc/jfs/t2647/273/4133170162/92430/592b3bd4/57a93818N829cab72.jpg" alt="...">
                                <div class="caption">
                                    <h3 style="color: red">￥99.00</h3>
                                    <p><a>波司登男装2016青年时尚休闲短袖圆领T恤 圆领竹纤维半截袖体恤 1262Z13086 黄色 M</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading">商品介绍</div>
                        <div class="panel-body" style="padding: 10px;height: auto">
                            <?php if ($data['sysAttr']) { ?>
                                <?php foreach ($data['sysAttr'] as $name => $val) { ?>
                                    <div style="width: 25%;float: left;height: 25px;line-height: 25px">
                                        <span style="font-weight: bold;color: #333"><?= $name;?>：</span>
                                        <span><?= implode(',', $val); ?></span>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                            <?php if ($data['extAttr']) { ?>
                                <?php foreach ($data['extAttr'] as $attr) { ?>
                                    <div style="width: 25%;float: left;height: 25px;line-height: 25px">
                                        <span style="font-weight: bold;color: #333"><?= $attr['name'];?>：</span>
                                        <span><?= $attr['value']; ?></span>
                                    </div>
                                <?php } ?>
                            <?php } ?>
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

<?php $this->registerJsFile('@web/public/frontend/js/photomatic.js',['depends' => \yii\web\JqueryAsset::className()])?>
<?php $this->beginBlock('jquery') ?>
<!--<script>-->
$(function() {
    $("#thumbnailsPane img").photomatic({
        photoElement : '#photoDisplay',
        transformer : function(name){
            return name.replace(/55/g, 300);
        }
    });

    var labelVal = [];
    $(".select-spec").click(function(){
        $(this).addClass("spec-on").siblings().removeClass("spec-on");
        var index = $(".spec-item").index($(this).parent().parent());

        if ($(this).data("type") == 1) {
            labelVal[index] = $.trim($(this).html());
        } else {
            labelVal[index] = $.trim($(this).children("img").attr("src"));
        }

        if (arrayLength(labelVal) == $(".spec-item").length) {
            alert("I want to request page");
        } else {
            console.log(arrayLength(labelVal));
        }
    });

    //数组长度（不包括空元素）
    function arrayLength(array) {
        var count = 0;
        for(var i = 0 ;i<array.length;i++) {
            if(array[i] != "" && typeof(array[i]) != "undefined") {
               count = count + 1;
            }
        }
        return count;
    }
});

<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['jquery'], \yii\web\View::POS_END); ?>



