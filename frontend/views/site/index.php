<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'ZCshop';
?>
<?= Html::cssFile('public/common/menu/css/jquery.tmailsider.css')?>
<?/*= Html::cssFile('public/common/taobao/css/style.css')*/?>

    <style type="text/css">
        .WJ_Menu{float:left;}
        .WJ_Menu ul { margin:0px; padding:0px; list-style:none; width:639px; font-size:16px; font-weight:bold;}
        .WJ_Menu ul li{ text-indent:18px;*text-indent:11px;margin:0px;padding:0px;position:relative; line-height:27px;}
        .WJ_Menu ul li ul{position:absolute;display:none; margin:-24px 0px 0px 72px; _margin:-23px 0px 0px 54px;width:600px;}
        .WJ_Menu ul li ul li{ float:left;display:block;line-height:22px; margin:2px 0px 0px 0px;padding:0px;font-size:12px;}
        .WJ_Menu ul li a{color:#000;width:120px;display:block;}
        .WJ_Menu ul li a:hover{color:#000;width:120px;display:block;}
        .overc{width:54px;border:solid 1px #ff0000;background-color:#567547;}
    </style>

<div class="site-index">

    <!--top start-->
    <div class="body-content" style="background-color: #ffffff; padding: 10px 10px;">
        <div class="row" style="height: 100px">
            <div class="col-lg-3" style="text-align: right">
                <img src="http://shop.cm/public/common/taobao/img/logo.gif">
            </div>
            <div class="col-lg-7" style="height: 100px;padding-top: 30px;">
                <div class="input-group" style="line-height: 100px">
                    <input type="text" class="form-control input-lg"><span class="input-group-addon btn btn-primary">搜索</span>
                </div>
            </div>
            <div class="col-lg-2">
            </div>
        </div>
        <div class="row" style="height:auto;">
            <div class="col-lg-3">
                <div class="WJ_Menu">
                    <ul id="Menu">
                        <li>
                            <a href="#">网站首页</a>
                            <ul class="over">
                                <div style="background-color: #00578d">
                                    <li><a href="#">周d遍</a></li>
                                    <li><a href="#">活动</a></li>
                                </div>

                            </ul>
                        </li>
                        <li>
                            <a href="#">网站首页</a>
                            <ul class="over">
                                <li><a href="#"  >周遍</a></li>
                                <li><a href="#"  >活动</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">网站首页</a>
                            <ul class="over">
                                <li><a href="#"  >周遍</a></li>
                                <li><a href="#"  >活动</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">网站首页</a>
                            <ul class="over">
                                <li><a href="#"  >周遍</a></li>
                                <li><a href="#"  >活动</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">sdfsdfsdfsdfsd</div>

        </div>
    </div>
    <!--top end-->

</div>

<script type="text/javascript" src="<?= Yii::$app->urlManager->baseUrl?>/public/common/menu/js/jquery-1.8.2.min.js"></script>
<script language="javascript">
    $(function(){
        $("#Menu>li").hover(function(){$(this).children("ul").css("display","block");},function(){$(this).children("ul").css("display","");});
    })
</script>
