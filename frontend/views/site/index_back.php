<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\web\JqueryAsset;

$this->title = 'zcShop商城系统';

?>
<style>
    ul{margin:0;padding:0;}
    img{border:none;}
    li{list-style:none;}
    input,select,textarea{outline:none;}
    textarea{resize:none;}
    a{text-decoration:none;}


    /*清浮动*/
    .clearfix:after{content:"";display:block;clear:both;}
    .clearfix{zoom:1;}

    /* banner */
    .banner{ width: 100%; height: 400px; position: relative; overflow: hidden; margin-bottom: 0; margin-left: auto; margin-right: auto; margin-top: 10px; }
    .banner-btn{display:none;}
    .banner-btn a{display:block;line-height:40px;position:absolute;top:120px;width:40px;height:40px;background-color:#000;opacity:0.3;filter:alpha(opacity=30) color:rgb(255, 255, 255);overflow:hidden;z-index:4;}
    .prevBtn{left:5px;}
    .nextBtn{right:5px;}
    .banner-img{font-size:0;*word-spacing:-1px;/* IE6、7 */ letter-spacing:-3px;position:relative;}
    .banner-img li{display:inline-block;*display:inline;*zoom:1;/* IE6、7 */ vertical-align:top;letter-spacing:normal;word-spacing:normal;font-size:12px;}
    .banner i{background:url(http://gtms01.alicdn.com/tps/i1/T1szNBFzlmXXX8QSDI-400-340.png)  no-repeat;width:15px;height:23px;cursor:pointer;margin:8px 0 0 12px;display:block;}
    .banner .nextBtn i{background-position:-200px -24px;}
    .banner .prevBtn i{background-position:-200px 0px;}

    .banner-circle{position:absolute;left:50%;bottom:15px;height:13px;text-align:center;padding-left:0px;font-size:0;border-radius:10px;background:rgba(255,255,255,0.3);filter:alpha(opacity:30);}
    .banner-circle li{border-radius:10px;margin:2px;display:inline-block;display:-moz-inline-stack;vertical-align:middle;zoom:1;}
    .banner-circle li a{display:block;padding-top:9px;width:9px;height:0;border-radius:50%;background:#B7B7B7;overflow:hidden;}
    .banner-circle .selected a{background:#F40;}
</style>
<?= Html::cssFile('public/common/menu/css/jquery.tmailsider.css')?>
<div class="site-index">

    <!--<div class="jumbotron">
        <h1>Welcome To ZCshop</h1>
        <p class="lead">ZCshop基于YII2.0框架开发的一套商城系统，相对于其他系统，它具有高效，稳定，安全的优势</p>
        <p><a class="btn btn-lg btn-success" href="<?/*= Yii::$app->urlManager->createUrl(['goods/list', 'cid' => 4])*/?>">ZC商城系统</a></p>
    </div>-->

    <div class="body-content">
        <div class="row">
            <div class="col-lg-3">
                <div id="Z_TypeList" class="Z_TypeList">
                    <h1 class="title">所有商品分类</h1>
                    <div class="Z_MenuList">
                        <ul>
                            <li class="list-item0">
                                <h3>服装/内衣/配件</h3>
                                <p>
                                    <a href="http://www.17sucai.com/">女装</a>
                                    <a href="http://www.17sucai.com/">男装</a>
                                    <a href="http://www.17sucai.com/">内衣</a>
                                    <a href="http://www.17sucai.com/">羽绒</a>
                                    <a href="http://www.17sucai.com/">呢大衣</a>
                                </p>
                                <p>
                                    <a href="http://www.17sucai.com/">毛衣</a>
                                    <a href="http://www.17sucai.com/">保暖</a>
                                    <a href="http://www.17sucai.com/">睡衣</a>
                                    <a href="http://www.17sucai.com/">男羽绒</a>
                                    <a href="http://www.17sucai.com/">男毛衣</a>
                                </p>
                            </li>
                            <li class="list-item1 alt">
                                <h3>鞋/箱包</h3>
                                <p>
                                    <a href="http://www.17sucai.com/">女鞋</a>
                                    <a href="http://www.17sucai.com/">男鞋</a>
                                    <a href="http://www.17sucai.com/">雪地靴</a>
                                    <a href="http://www.17sucai.com/">靴子</a>
                                    <a href="http://www.17sucai.com/">男靴</a>
                                </p>
                                <p>
                                    <a href="http://www.17sucai.com/">箱包</a>
                                    <a href="http://www.17sucai.com/">女包</a>
                                    <a href="http://www.17sucai.com/">男包</a>
                                    <a href="http://www.17sucai.com/">拉杆箱</a>
                                    <a href="http://www.17sucai.com/">钱包</a>
                                </p>
                            </li>
                            <li class="list-item2">
                                <h3>珠宝饰品/手表眼睛</h3>
                                <p>
                                    <a href="http://www.17sucai.com/">珠宝</a>
                                    <a href="http://www.17sucai.com/">足金</a>
                                    <a href="http://www.17sucai.com/">钻戒</a>
                                    <a href="http://www.17sucai.com/">玉镯</a>
                                    <a href="http://www.17sucai.com/">珍珠</a>
                                </p>
                                <p>
                                    <a href="http://www.17sucai.com/">手表</a>
                                    <a href="http://www.17sucai.com/">饰品</a>
                                    <a href="http://www.17sucai.com/">毛衣链</a>
                                    <a href="http://www.17sucai.com/">手链</a>
                                    <a href="http://www.17sucai.com/">瑞士军刀</a>
                                </p>
                            </li>
                            <li class="list-item3 alt">
                                <h3>化妆品</h3>
                                <p>
                                    <a href="http://www.17sucai.com/">护肤</a>
                                    <a href="http://www.17sucai.com/">彩妆</a>
                                    <a href="http://www.17sucai.com/">假发</a>
                                    <a href="http://www.17sucai.com/">香水</a>
                                    <a href="http://www.17sucai.com/">男士护肤</a>
                                </p>
                                <p>
                                    <a href="http://www.17sucai.com/">套装</a>
                                    <a href="http://www.17sucai.com/">面膜</a>
                                    <a href="http://www.17sucai.com/">洁面</a>
                                    <a href="http://www.17sucai.com/">眼霜</a>
                                    <a href="http://www.17sucai.com/">BB霜</a>
                                    <a href="http://www.17sucai.com/">爽肤水</a>
                                </p>
                            </li>
                            <li class="list-item4">
                                <h3>运动户外</h3>
                                <p>
                                    <a href="http://www.17sucai.com/">运动鞋</a>
                                    <a href="http://www.17sucai.com/">运动服</a>
                                    <a href="http://www.17sucai.com/">户外</a>
                                    <a href="http://www.17sucai.com/">用品</a>
                                    <a href="http://www.17sucai.com/">板鞋</a>
                                </p>
                                <p>
                                    <a href="http://www.17sucai.com/">跑步鞋</a>
                                    <a href="http://www.17sucai.com/">羽绒服</a>
                                    <a href="http://www.17sucai.com/">冲锋衣</a>
                                    <a href="http://www.17sucai.com/">跑步机</a>
                                </p>
                            </li>
                            <li class="list-item5 alt">
                                <h3>手机数码</h3>
                                <p>
                                    <a href="http://www.17sucai.com/">手机</a>
                                    <a href="http://www.17sucai.com/">相机</a>
                                    <a href="http://www.17sucai.com/">笔记本</a>
                                    <a href="http://www.17sucai.com/">平板</a>
                                    <a href="http://www.17sucai.com/">硬件</a>
                                </p>
                                <p>
                                    <a href="http://www.17sucai.com/">配件</a>
                                    <a href="http://www.17sucai.com/">视听</a>
                                    <a href="http://www.17sucai.com/">移动存储</a>
                                    <a href="http://www.17sucai.com/">台式机</a>
                                </p>
                            </li>
                            <li class="list-item6">
                                <h3>家用电器</h3>
                                <p>
                                    <a href="http://www.17sucai.com/">大家电</a>
                                    <a href="http://www.17sucai.com/">影音</a>
                                    <a href="http://www.17sucai.com/">电视</a>
                                    <a href="http://www.17sucai.com/">耳机</a>
                                    <a href="http://www.17sucai.com/">厨房</a>
                                </p>
                                <p>
                                    <a href="http://www.17sucai.com/">生活电器</a>
                                    <a href="http://www.17sucai.com/">取暖器</a>
                                    <a href="http://www.17sucai.com/">个人护理/保健</a>
                                </p>
                            </li>
                            <li class="list-item7 alt">
                                <h3>家具建材</h3>
                                <p>
                                    <a href="http://www.17sucai.com/">灯具</a>
                                    <a href="http://www.17sucai.com/">卫浴</a>
                                    <a href="http://www.17sucai.com/">油漆</a>
                                    <a href="http://www.17sucai.com/">开关</a>
                                    <a href="http://www.17sucai.com/">地板</a>
                                    <a href="http://www.17sucai.com/">墙纸</a>
                                </p>
                                <p>
                                    <a href="http://www.17sucai.com/">沙发</a>
                                    <a href="http://www.17sucai.com/">床</a>
                                    <a href="http://www.17sucai.com/">衣柜</a>
                                    <a href="http://www.17sucai.com/">床垫</a>
                                    <a href="http://www.17sucai.com/">架类</a>
                                    <a href="http://www.17sucai.com/">工具</a>
                                </p>
                            </li>
                            <li class="list-item8">
                                <h3>家纺/居家</h3>
                                <p>
                                    <a href="http://www.17sucai.com/">四件套</a>
                                    <a href="http://www.17sucai.com/">蚕丝被</a>
                                    <a href="http://www.17sucai.com/">冬被</a>
                                    <a href="http://www.17sucai.com/">枕头</a>
                                    <a href="http://www.17sucai.com/">家饰</a>
                                </p>
                                <p>
                                    <a href="http://www.17sucai.com/">厨房</a>
                                    <a href="http://www.17sucai.com/">杯子</a>
                                    <a href="http://www.17sucai.com/">清洁</a>
                                    <a href="http://www.17sucai.com/">收纳</a>
                                    <a href="http://www.17sucai.com/">宠物</a>
                                    <a href="http://www.17sucai.com/">居家</a>
                                </p>
                            </li>
                            <li class="list-item9 alt">
                                <h3>母婴玩具</h3>
                                <p>
                                    <a href="http://www.17sucai.com/">奶粉</a>
                                    <a href="http://www.17sucai.com/">尿裤</a>
                                    <a href="http://www.17sucai.com/">童装</a>
                                    <a href="http://www.17sucai.com/">孕产</a>
                                    <a href="http://www.17sucai.com/">玩具</a>
                                    <a href="http://www.17sucai.com/">车床</a>
                                </p>
                                <p>
                                    <a href="http://www.17sucai.com/">辅食</a>
                                    <a href="http://www.17sucai.com/">用品</a>
                                    <a href="http://www.17sucai.com/">童鞋</a>
                                    <a href="http://www.17sucai.com/">月子</a>
                                    <a href="http://www.17sucai.com/">大人玩乐</a>
                                </p>
                            </li>
                            <li class="list-item10">
                                <h3>食品</h3>
                                <p>
                                    <a href="http://www.17sucai.com/">零食</a>
                                    <a href="http://www.17sucai.com/">坚果</a>
                                    <a href="http://www.17sucai.com/">茶叶</a>
                                    <a href="http://www.17sucai.com/">冲饮</a>
                                    <a href="http://www.17sucai.com/">粮油</a>
                                    <a href="http://www.17sucai.com/">生鲜</a>
                                </p>
                                <p>
                                    <a href="http://www.17sucai.com/">酒水</a>
                                    <a href="http://www.17sucai.com/">白酒</a>
                                    <a href="http://www.17sucai.com/">葡萄酒</a>
                                    <a href="http://www.17sucai.com/">巧克力</a>
                                    <a href="http://www.17sucai.com/">进口</a>
                                </p>
                            </li>
                            <li class="list-item11 alt">
                                <h3>医药保健</h3>
                                <p>
                                    <a href="http://www.17sucai.com/">保健</a>
                                    <a href="http://www.17sucai.com/">滋补</a>
                                    <a href="http://www.17sucai.com/">养生</a>
                                    <a href="http://www.17sucai.com/">食疗</a>
                                    <a href="http://www.17sucai.com/">提高免疫</a>
                                </p>
                                <p>
                                    <a href="http://www.17sucai.com/">药品</a>
                                    <a href="http://www.17sucai.com/">血压</a>
                                    <a href="http://www.17sucai.com/">美瞳</a>
                                    <a href="http://www.17sucai.com/">计生</a>
                                    <a href="http://www.17sucai.com/">体检</a>
                                </p>
                            </li>
                            <li class="list-item12">
                                <h3>汽车配件</h3>
                                <p>
                                    <a href="http://www.17sucai.com/">汽车</a>
                                    <a href="http://www.17sucai.com/">汽车用品</a>
                                    <a href="http://www.17sucai.com/">坐垫</a>
                                    <a href="http://www.17sucai.com/">座套</a>
                                </p>
                                <p>
                                    <a href="http://www.17sucai.com/">脚垫</a>
                                    <a href="http://www.17sucai.com/">GPS</a>
                                    <a href="http://www.17sucai.com/">儿童安全座椅</a>
                                    <a href="http://www.17sucai.com/">改装</a>
                                </p>
                            </li>
                            <li class="list-item13 alt">
                                <h3>图书音像</h3>
                                <p>
                                    <a href="http://www.17sucai.com/">考试</a>
                                    <a href="http://www.17sucai.com/">儿童</a>
                                    <a href="http://www.17sucai.com/">小说</a>
                                    <a href="http://www.17sucai.com/">外语</a>
                                    <a href="http://www.17sucai.com/">社科</a>
                                    <a href="http://www.17sucai.com/">艺术</a>
                                </p>
                                <p>
                                    <a href="http://www.17sucai.com/">养生</a>
                                    <a href="http://www.17sucai.com/">文学</a>
                                    <a href="http://www.17sucai.com/">动漫</a>
                                    <a href="http://www.17sucai.com/">杂志</a>
                                    <a href="http://www.17sucai.com/">心理</a>
                                    <a href="http://www.17sucai.com/">管理</a>
                                </p>
                            </li>
                            <li class="list-item14">
                                <h3>文化娱乐</h3>
                                <p>
                                    <a href="http://www.17sucai.com/">电子凭证</a>
                                    <a href="http://www.17sucai.com/">小猫提货</a>
                                    <a href="http://www.17sucai.com/">乐器</a>
                                    <a href="http://www.17sucai.com/">旅游</a>
                                </p>
                                <p>
                                    <a href="http://www.17sucai.com/">网店软件</a>
                                    <a href="http://www.17sucai.com/">古董字画</a>
                                    <a href="http://www.17sucai.com/">个性定制</a>
                                </p>
                            </li>
                            <li class="list-item15 alt">
                                <h3>手机/网游点卡</h3>
                            </li>
                        </ul>
                    </div>
                    <div class="Z_SubList">
                        <div class="subView">
                            <ul>
                                <li class="subItem">
                                    <h3 class="subItem-hd"><a target="_blank" href="http://www.17sucai.com/">服装/内衣/配件</a></h3>
                                    <p class="subItem-cat">
                                        <a target="_blank" href="http://www.17sucai.com/">羽绒服</a>
                                        <a target="_blank" href="http://www.17sucai.com/">毛衣</a>
                                        <a target="_blank" href="http://www.17sucai.com/">棉衣棉服</a>
                                        <a target="_blank" href="http://www.17sucai.com/">毛呢外套</a>
                                        <a target="_blank" href="http://www.17sucai.com/">打底裤</a>
                                        <a target="_blank" href="http://www.17sucai.com/">休闲裤</a>
                                        <a target="_blank" href="http://www.17sucai.com/">连衣裙</a>
                                        <a target="_blank" href="http://www.17sucai.com/">牛仔裤</a>
                                        <a target="_blank" href="http://www.17sucai.com/">中老年服装</a>
                                        <a target="_blank" href="http://www.17sucai.com/">针织衫</a>
                                        <a target="_blank" href="http://www.17sucai.com/">T恤</a>
                                        <a target="_blank" href="http://www.17sucai.com/">卫衣</a>
                                        <a target="_blank" href="http://www.17sucai.com/">半身裙</a>
                                        <a target="_blank" href="http://www.17sucai.com/">皮草</a>
                                        <a target="_blank" href="http://www.17sucai.com/">婚纱/礼服/旗袍</a>
                                        <a target="_blank" href="http://www.17sucai.com/">真皮皮衣</a>
                                        <a target="_blank" href="http://www.17sucai.com/">衬衫</a>
                                        <a target="_blank" href="http://www.17sucai.com/">风衣</a>
                                        <a target="_blank" href="http://www.17sucai.com/">婚纱</a>
                                    </p>
                                    <h4 class="subItem-title brandTitle">品牌：</h4>
                                    <p class="subItem-brand">
                                        <a target="_blank" href="http://www.17sucai.com/">波司登</a>
                                        <a target="_blank" href="http://www.17sucai.com/">ochirly</a>
                                        <a target="_blank" href="http://www.17sucai.com/">韩都衣舍</a>
                                        <a target="_blank" href="http://www.17sucai.com/">裂帛</a>
                                        <a target="_blank" href="http://www.17sucai.com/">优衣库</a>
                                        <a target="_blank" href="http://www.17sucai.com/">only</a>
                                        <a target="_blank" href="http://www.17sucai.com/">秋水伊人</a>
                                        <a target="_blank" href="http://www.17sucai.com/">哥弟</a>
                                        <a target="_blank" href="http://www.17sucai.com/">粉红大布娃娃</a>
                                        <a target="_blank" href="http://www.17sucai.com/">三彩</a>
                                        <a target="_blank" href="http://www.17sucai.com/">歌莉娅</a>
                                        <a target="_blank" href="http://www.17sucai.com/">茵曼</a>
                                        <a target="_blank" href="http://www.17sucai.com/">艾莱依</a>
                                        <a target="_blank" href="http://www.17sucai.com/">衣香丽影</a>
                                        <a target="_blank" href="http://www.17sucai.com/">江南布衣</a>
                                        <a target="_blank" href="http://www.17sucai.com/">纳纹</a>
                                        <a target="_blank" href="http://www.17sucai.com/">播</a>
                                        <a target="_blank" href="http://www.17sucai.com/">香影</a>
                                        <a target="_blank" href="http://www.17sucai.com/">雅鹿</a>
                                        <a target="_blank" href="http://www.17sucai.com/">OSA</a>
                                    </p>
                                </li>
                                <li class="subItem">
                                    <h3 class="subItem-hd"><a target="_blank" href="http://www.17sucai.com/">服饰配件</a></h3>
                                    <p class="subItem-cat">
                                        <a target="_blank" href="http://www.17sucai.com/">女士丝巾/围巾/披肩</a>
                                        <a target="_blank" href="http://www.17sucai.com/">男士皮带</a>
                                        <a target="_blank" href="http://www.17sucai.com/">女士腰带</a>
                                        <a target="_blank" href="http://www.17sucai.com/">毛线</a>
                                        <a target="_blank" href="http://www.17sucai.com/">手套</a>
                                        <a target="_blank" href="http://www.17sucai.com/">帽子</a>
                                        <a target="_blank" href="http://www.17sucai.com/">男士围巾</a>
                                        <a target="_blank" href="http://www.17sucai.com/">领带/领结</a>
                                    </p>
                                    <h4 class="subItem-title brandTitle">品牌：</h4>
                                    <p class="subItem-brand">
                                        <a target="_blank" href="http://www.17sucai.com/">七匹狼</a>
                                        <a target="_blank" href="http://www.17sucai.com/">Rayli</a>
                                        <a target="_blank" href="http://www.17sucai.com/">CARTELO</a>
                                    </p>
                                </li>
                            </ul>

                            <ul>
                                <li class="subItem">
                                    <h3 class="subItem-hd"><a target="_blank" href="http://www.17sucai.com/">精品男装</a></h3>
                                    <p class="subItem-cat">
                                        <a target="_blank" href="http://www.17sucai.com/">羽绒服</a>
                                        <a target="_blank" href="http://www.17sucai.com/">毛衣</a>
                                        <a target="_blank" href="http://www.17sucai.com/">棉衣</a>
                                        <a target="_blank" href="http://www.17sucai.com/">皮衣</a>
                                        <a target="_blank" href="http://www.17sucai.com/">牛仔裤</a>
                                        <a target="_blank" href="http://www.17sucai.com/">呢大衣</a>
                                        <a target="_blank" href="http://www.17sucai.com/">风衣</a>
                                        <a target="_blank" href="http://www.17sucai.com/">夹克</a>
                                        <a target="_blank" href="http://www.17sucai.com/">羊绒衫</a>
                                        <a target="_blank" href="http://www.17sucai.com/">休闲裤</a>
                                        <a target="_blank" href="http://www.17sucai.com/">卫衣</a>
                                        <a target="_blank" href="http://www.17sucai.com/">马甲/背心</a>
                                        <a target="_blank" href="http://www.17sucai.com/">衬衫</a>
                                        <a target="_blank" href="http://www.17sucai.com/">t恤</a>
                                        <a target="_blank" href="http://www.17sucai.com/">针织衫</a>
                                        <a target="_blank" href="http://www.17sucai.com/">皮裤</a>
                                        <a target="_blank" href="http://www.17sucai.com/">西服</a>
                                        <a target="_blank" href="http://www.17sucai.com/">西裤</a>
                                        <a target="_blank" href="http://www.17sucai.com/">西服套装</a>
                                        <a target="_blank" href="http://www.17sucai.com/">中老年服装</a>
                                    </p>
                                    <h4 class="subItem-title brandTitle">品牌：</h4>
                                    <p class="subItem-brand">
                                        <a target="_blank" href="http://www.17sucai.com/">七匹狼</a>
                                        <a target="_blank" href="http://www.17sucai.com/">JACKJONES</a>
                                        <a target="_blank" href="http://www.17sucai.com/">太平鸟</a>
                                        <a target="_blank" href="http://www.17sucai.com/">GXG</a>
                                        <a target="_blank" href="http://www.17sucai.com/">恒源祥</a>
                                        <a target="_blank" href="http://www.17sucai.com/">劲霸</a>
                                        <a target="_blank" href="http://www.17sucai.com/">马克华菲</a>
                                        <a target="_blank" href="http://www.17sucai.com/">九牧王</a>
                                        <a target="_blank" href="http://www.17sucai.com/">利郎</a>
                                        <a target="_blank" href="http://www.17sucai.com/">LEE</a>
                                        <a target="_blank" href="http://www.17sucai.com/">柒牌</a>
                                        <a target="_blank" href="http://www.17sucai.com/">LEVI'S</a>
                                        <a target="_blank" href="http://www.17sucai.com/">SELECTED</a>
                                        <a target="_blank" href="http://www.17sucai.com/">杉杉</a>
                                        <a target="_blank" href="http://www.17sucai.com/">雅戈尔</a>
                                        <a target="_blank" href="http://www.17sucai.com/">DICKIES</a>
                                        <a target="_blank" href="http://www.17sucai.com/">诺帝卡</a>
                                        <a target="_blank" href="http://www.17sucai.com/">报喜鸟</a>
                                    </p>
                                </li>
                                <li class="subItem">
                                    <h3 class="subItem-hd"><a target="_blank" href="http://www.17sucai.com/">时尚家居</a></h3>
                                    <p class="subItem-cat">
                                        <a target="_blank" href="http://www.17sucai.com/">睡衣套装</a>
                                        <a target="_blank" href="http://www.17sucai.com/">夹棉家居服</a>
                                        <a target="_blank" href="http://www.17sucai.com/">珊瑚绒家居服</a>
                                        <a target="_blank" href="http://www.17sucai.com/">情侣套装</a>
                                        <a target="_blank" href="http://www.17sucai.com/">卡通睡衣</a>
                                        <a target="_blank" href="http://www.17sucai.com/">睡袍</a>
                                        <a target="_blank" href="http://www.17sucai.com/">睡裙</a>
                                        <a target="_blank" href="http://www.17sucai.com/">睡裤</a>
                                    </p>
                                    <h4 class="subItem-title brandTitle">品牌：</h4>
                                    <p class="subItem-brand">
                                        <a target="_blank" href="http://www.17sucai.com/">芬腾</a>
                                        <a target="_blank" href="http://www.17sucai.com/">安之伴</a>
                                        <a target="_blank" href="http://www.17sucai.com/">派邦奴</a>
                                        <a target="_blank" href="http://www.17sucai.com/">秋鹿</a>
                                        <a target="_blank" href="http://www.17sucai.com/">睦隆世家</a>
                                        <a target="_blank" href="http://www.17sucai.com/">雪俐</a>
                                        <a target="_blank" href="http://www.17sucai.com/">爱帝</a>
                                        <a target="_blank" href="http://www.17sucai.com/">美梦</a>
                                    </p>
                                </li>
                            </ul>

                            <ul>
                                <li class="subItem">
                                    <h3 class="subItem-hd"><a target="_blank" href="http://www.17sucai.com/">精致内衣</a></h3>
                                    <p class="subItem-cat">
                                        <a target="_blank" href="http://www.17sucai.com/">保暖套装</a>
                                        <a target="_blank" href="http://www.17sucai.com/">保暖上衣</a>
                                        <a target="_blank" href="http://www.17sucai.com/">精品文胸</a>
                                        <a target="_blank" href="http://www.17sucai.com/">塑身衣</a>
                                        <a target="_blank" href="http://www.17sucai.com/">女式内裤</a>
                                        <a target="_blank" href="http://www.17sucai.com/">文胸套装</a>
                                        <a target="_blank" href="http://www.17sucai.com/">中筒袜</a>
                                        <a target="_blank" href="http://www.17sucai.com/">连裤袜</a>
                                        <a target="_blank" href="http://www.17sucai.com/">男式内裤</a>
                                        <a target="_blank" href="http://www.17sucai.com/">保暖裤</a>
                                        <a target="_blank" href="http://www.17sucai.com/">聚拢文胸</a>
                                        <a target="_blank" href="http://www.17sucai.com/">美腿袜</a>
                                    </p>
                                    <h4 class="subItem-title brandTitle">品牌：</h4>
                                    <p class="subItem-brand">
                                        <a target="_blank" href="http://www.17sucai.com/">七匹狼</a>
                                        <a target="_blank" href="http://www.17sucai.com/">浪莎</a>
                                        <a target="_blank" href="http://www.17sucai.com/">波司登</a>
                                        <a target="_blank" href="http://www.17sucai.com/">南极人</a>
                                        <a target="_blank" href="http://www.17sucai.com/">恒源祥</a>
                                        <a target="_blank" href="http://www.17sucai.com/">北极绒</a>
                                        <a target="_blank" href="http://www.17sucai.com/">爱慕</a>
                                        <a target="_blank" href="http://www.17sucai.com/">曼妮芬</a>
                                        <a target="_blank" href="http://www.17sucai.com/">歌瑞尔</a>
                                        <a target="_blank" href="http://www.17sucai.com/">古今</a>
                                        <a target="_blank" href="http://www.17sucai.com/">猫人</a>
                                        <a target="_blank" href="http://www.17sucai.com/">安莉芳</a>
                                        <a target="_blank" href="http://www.17sucai.com/">夏娃之秀</a>
                                        <a target="_blank" href="http://www.17sucai.com/">黛安芬</a>
                                        <a target="_blank" href="http://www.17sucai.com/">金三塔</a>
                                    </p>
                                </li>
                                <p class="subItemAd">
                                    <a target="_blank" href="http://www.17sucai.com/"><img width="218" height="32" alt="潮流服饰精选" src="http://img04.taobaocdn.com/tps/i4/T1dVzWXbpjXXb12rTm-218-32.png"></a>
                                </p>
                            </ul>
                        </div>
                        <div class="subView">
                            <ul>
                                <li class="subItem">
                                    <h3 class="subItem-hd"><a target="_blank" href="http://www.17sucai.com/">鞋/箱包</a></h3>
                                    <p class="subItem-cat">
                                        <a target="_blank" href="http://www.17sucai.com/">羽绒服</a>
                                        <a target="_blank" href="http://www.17sucai.com/">毛衣</a>
                                        <a target="_blank" href="http://www.17sucai.com/">棉衣棉服</a>
                                        <a target="_blank" href="http://www.17sucai.com/">毛呢外套</a>
                                        <a target="_blank" href="http://www.17sucai.com/">打底裤</a>
                                        <a target="_blank" href="http://www.17sucai.com/">休闲裤</a>
                                        <a target="_blank" href="http://www.17sucai.com/">连衣裙</a>
                                        <a target="_blank" href="http://www.17sucai.com/">牛仔裤</a>
                                        <a target="_blank" href="http://www.17sucai.com/">中老年服装</a>
                                        <a target="_blank" href="http://www.17sucai.com/">针织衫</a>
                                        <a target="_blank" href="http://www.17sucai.com/">T恤</a>
                                        <a target="_blank" href="http://www.17sucai.com/">卫衣</a>
                                        <a target="_blank" href="http://www.17sucai.com/">半身裙</a>
                                        <a target="_blank" href="http://www.17sucai.com/">皮草</a>
                                        <a target="_blank" href="http://www.17sucai.com/">婚纱/礼服/旗袍</a>
                                        <a target="_blank" href="http://www.17sucai.com/">真皮皮衣</a>
                                        <a target="_blank" href="http://www.17sucai.com/">衬衫</a>
                                        <a target="_blank" href="http://www.17sucai.com/">风衣</a>
                                        <a target="_blank" href="http://www.17sucai.com/">婚纱</a>
                                    </p>
                                    <h4 class="subItem-title brandTitle">品牌：</h4>
                                    <p class="subItem-brand">
                                        <a target="_blank" href="http://www.17sucai.com/">波司登</a>
                                        <a target="_blank" href="http://www.17sucai.com/">ochirly</a>
                                        <a target="_blank" href="http://www.17sucai.com/">韩都衣舍</a>
                                        <a target="_blank" href="http://www.17sucai.com/">裂帛</a>
                                        <a target="_blank" href="http://www.17sucai.com/">优衣库</a>
                                        <a target="_blank" href="http://www.17sucai.com/">only</a>
                                        <a target="_blank" href="http://www.17sucai.com/">秋水伊人</a>
                                        <a target="_blank" href="http://www.17sucai.com/">哥弟</a>
                                        <a target="_blank" href="http://www.17sucai.com/">粉红大布娃娃</a>
                                        <a target="_blank" href="http://www.17sucai.com/">三彩</a>
                                        <a target="_blank" href="http://www.17sucai.com/">歌莉娅</a>
                                        <a target="_blank" href="http://www.17sucai.com/">茵曼</a>
                                        <a target="_blank" href="http://www.17sucai.com/">艾莱依</a>
                                        <a target="_blank" href="http://www.17sucai.com/">衣香丽影</a>
                                        <a target="_blank" href="http://www.17sucai.com/">江南布衣</a>
                                        <a target="_blank" href="http://www.17sucai.com/">纳纹</a>
                                        <a target="_blank" href="http://www.17sucai.com/">播</a>
                                        <a target="_blank" href="http://www.17sucai.com/">香影</a>
                                        <a target="_blank" href="http://www.17sucai.com/">雅鹿</a>
                                        <a target="_blank" href="http://www.17sucai.com/">OSA</a>
                                    </p>
                                </li>
                                <li class="subItem">
                                    <h3 class="subItem-hd"><a target="_blank" href="http://www.17sucai.com/">服饰配件</a></h3>
                                    <p class="subItem-cat">
                                        <a target="_blank" href="http://www.17sucai.com/">女士丝巾/围巾/披肩</a>
                                        <a target="_blank" href="http://www.17sucai.com/">男士皮带</a>
                                        <a target="_blank" href="http://www.17sucai.com/">女士腰带</a>
                                        <a target="_blank" href="http://www.17sucai.com/">毛线</a>
                                        <a target="_blank" href="http://www.17sucai.com/">手套</a>
                                        <a target="_blank" href="http://www.17sucai.com/">帽子</a>
                                        <a target="_blank" href="http://www.17sucai.com/">男士围巾</a>
                                        <a target="_blank" href="http://www.17sucai.com/">领带/领结</a>
                                    </p>
                                    <h4 class="subItem-title brandTitle">品牌：</h4>
                                    <p class="subItem-brand">
                                        <a target="_blank" href="http://www.17sucai.com/">七匹狼</a>
                                        <a target="_blank" href="http://www.17sucai.com/">Rayli</a>
                                        <a target="_blank" href="http://www.17sucai.com/">CARTELO</a>
                                    </p>
                                </li>
                            </ul>

                            <ul>
                                <li class="subItem">
                                    <h3 class="subItem-hd"><a target="_blank" href="http://www.17sucai.com/">精品男装</a></h3>
                                    <p class="subItem-cat">
                                        <a target="_blank" href="http://www.17sucai.com/">羽绒服</a>
                                        <a target="_blank" href="http://www.17sucai.com/">毛衣</a>
                                        <a target="_blank" href="http://www.17sucai.com/">棉衣</a>
                                        <a target="_blank" href="http://www.17sucai.com/">皮衣</a>
                                        <a target="_blank" href="http://www.17sucai.com/">牛仔裤</a>
                                        <a target="_blank" href="http://www.17sucai.com/">呢大衣</a>
                                        <a target="_blank" href="http://www.17sucai.com/">风衣</a>
                                        <a target="_blank" href="http://www.17sucai.com/">夹克</a>
                                        <a target="_blank" href="http://www.17sucai.com/">羊绒衫</a>
                                        <a target="_blank" href="http://www.17sucai.com/">休闲裤</a>
                                        <a target="_blank" href="http://www.17sucai.com/">卫衣</a>
                                        <a target="_blank" href="http://www.17sucai.com/">马甲/背心</a>
                                        <a target="_blank" href="http://www.17sucai.com/">衬衫</a>
                                        <a target="_blank" href="http://www.17sucai.com/">t恤</a>
                                        <a target="_blank" href="http://www.17sucai.com/">针织衫</a>
                                        <a target="_blank" href="http://www.17sucai.com/">皮裤</a>
                                        <a target="_blank" href="http://www.17sucai.com/">西服</a>
                                        <a target="_blank" href="http://www.17sucai.com/">西裤</a>
                                        <a target="_blank" href="http://www.17sucai.com/">西服套装</a>
                                        <a target="_blank" href="http://www.17sucai.com/">中老年服装</a>
                                    </p>
                                    <h4 class="subItem-title brandTitle">品牌：</h4>
                                    <p class="subItem-brand">
                                        <a target="_blank" href="http://www.17sucai.com/">七匹狼</a>
                                        <a target="_blank" href="http://www.17sucai.com/">JACKJONES</a>
                                        <a target="_blank" href="http://www.17sucai.com/">太平鸟</a>
                                        <a target="_blank" href="http://www.17sucai.com/">GXG</a>
                                        <a target="_blank" href="http://www.17sucai.com/">恒源祥</a>
                                        <a target="_blank" href="http://www.17sucai.com/">劲霸</a>
                                        <a target="_blank" href="http://www.17sucai.com/">马克华菲</a>
                                        <a target="_blank" href="http://www.17sucai.com/">九牧王</a>
                                        <a target="_blank" href="http://www.17sucai.com/">利郎</a>
                                        <a target="_blank" href="http://www.17sucai.com/">LEE</a>
                                        <a target="_blank" href="http://www.17sucai.com/">柒牌</a>
                                        <a target="_blank" href="http://www.17sucai.com/">LEVI'S</a>
                                        <a target="_blank" href="http://www.17sucai.com/">SELECTED</a>
                                        <a target="_blank" href="http://www.17sucai.com/">杉杉</a>
                                        <a target="_blank" href="http://www.17sucai.com/">雅戈尔</a>
                                        <a target="_blank" href="http://www.17sucai.com/">DICKIES</a>
                                        <a target="_blank" href="http://www.17sucai.com/">诺帝卡</a>
                                        <a target="_blank" href="http://www.17sucai.com/">报喜鸟</a>
                                    </p>
                                </li>
                                <li class="subItem">
                                    <h3 class="subItem-hd"><a target="_blank" href="http://www.17sucai.com/">时尚家居</a></h3>
                                    <p class="subItem-cat">
                                        <a target="_blank" href="http://www.17sucai.com/">睡衣套装</a>
                                        <a target="_blank" href="http://www.17sucai.com/">夹棉家居服</a>
                                        <a target="_blank" href="http://www.17sucai.com/">珊瑚绒家居服</a>
                                        <a target="_blank" href="http://www.17sucai.com/">情侣套装</a>
                                        <a target="_blank" href="http://www.17sucai.com/">卡通睡衣</a>
                                        <a target="_blank" href="http://www.17sucai.com/">睡袍</a>
                                        <a target="_blank" href="http://www.17sucai.com/">睡裙</a>
                                        <a target="_blank" href="http://www.17sucai.com/">睡裤</a>
                                    </p>
                                    <h4 class="subItem-title brandTitle">品牌：</h4>
                                    <p class="subItem-brand">
                                        <a target="_blank" href="http://www.17sucai.com/">芬腾</a>
                                        <a target="_blank" href="http://www.17sucai.com/">安之伴</a>
                                        <a target="_blank" href="http://www.17sucai.com/">派邦奴</a>
                                        <a target="_blank" href="http://www.17sucai.com/">秋鹿</a>
                                        <a target="_blank" href="http://www.17sucai.com/">睦隆世家</a>
                                        <a target="_blank" href="http://www.17sucai.com/">雪俐</a>
                                        <a target="_blank" href="http://www.17sucai.com/">爱帝</a>
                                        <a target="_blank" href="http://www.17sucai.com/">美梦</a>
                                    </p>
                                </li>
                            </ul>

                            <ul>
                                <li class="subItem">
                                    <h3 class="subItem-hd"><a target="_blank" href="http://www.17sucai.com/">精致内衣</a></h3>
                                    <p class="subItem-cat">
                                        <a target="_blank" href="http://www.17sucai.com/">保暖套装</a>
                                        <a target="_blank" href="http://www.17sucai.com/">保暖上衣</a>
                                        <a target="_blank" href="http://www.17sucai.com/">精品文胸</a>
                                        <a target="_blank" href="http://www.17sucai.com/">塑身衣</a>
                                        <a target="_blank" href="http://www.17sucai.com/">女式内裤</a>
                                        <a target="_blank" href="http://www.17sucai.com/">文胸套装</a>
                                        <a target="_blank" href="http://www.17sucai.com/">中筒袜</a>
                                        <a target="_blank" href="http://www.17sucai.com/">连裤袜</a>
                                        <a target="_blank" href="http://www.17sucai.com/">男式内裤</a>
                                        <a target="_blank" href="http://www.17sucai.com/">保暖裤</a>
                                        <a target="_blank" href="http://www.17sucai.com/">聚拢文胸</a>
                                        <a target="_blank" href="http://www.17sucai.com/">美腿袜</a>
                                    </p>
                                    <h4 class="subItem-title brandTitle">品牌：</h4>
                                    <p class="subItem-brand">
                                        <a target="_blank" href="http://www.17sucai.com/">七匹狼</a>
                                        <a target="_blank" href="http://www.17sucai.com/">浪莎</a>
                                        <a target="_blank" href="http://www.17sucai.com/">波司登</a>
                                        <a target="_blank" href="http://www.17sucai.com/">南极人</a>
                                        <a target="_blank" href="http://www.17sucai.com/">恒源祥</a>
                                        <a target="_blank" href="http://www.17sucai.com/">北极绒</a>
                                        <a target="_blank" href="http://www.17sucai.com/">爱慕</a>
                                        <a target="_blank" href="http://www.17sucai.com/">曼妮芬</a>
                                        <a target="_blank" href="http://www.17sucai.com/">歌瑞尔</a>
                                        <a target="_blank" href="http://www.17sucai.com/">古今</a>
                                        <a target="_blank" href="http://www.17sucai.com/">猫人</a>
                                        <a target="_blank" href="http://www.17sucai.com/">安莉芳</a>
                                        <a target="_blank" href="http://www.17sucai.com/">夏娃之秀</a>
                                        <a target="_blank" href="http://www.17sucai.com/">黛安芬</a>
                                        <a target="_blank" href="http://www.17sucai.com/">金三塔</a>
                                    </p>
                                </li>
                                <p class="subItemAd">
                                    <a target="_blank" href="http://www.17sucai.com/"><img width="218" height="32" alt="潮流服饰精选" src="http://img04.taobaocdn.com/tps/i4/T1dVzWXbpjXXb12rTm-218-32.png"></a>
                                </p>
                            </ul>
                        </div>
                        <div class="subView">
                            <ul>
                                <li class="subItem">
                                    <h3 class="subItem-hd"><a target="_blank" href="http://www.17sucai.com/">珠宝饰品/手表眼睛</a></h3>
                                    <p class="subItem-cat">
                                        <a target="_blank" href="http://www.17sucai.com/">羽绒服</a>
                                        <a target="_blank" href="http://www.17sucai.com/">毛衣</a>
                                        <a target="_blank" href="http://www.17sucai.com/">棉衣棉服</a>
                                        <a target="_blank" href="http://www.17sucai.com/">毛呢外套</a>
                                        <a target="_blank" href="http://www.17sucai.com/">打底裤</a>
                                        <a target="_blank" href="http://www.17sucai.com/">休闲裤</a>
                                        <a target="_blank" href="http://www.17sucai.com/">连衣裙</a>
                                        <a target="_blank" href="http://www.17sucai.com/">牛仔裤</a>
                                        <a target="_blank" href="http://www.17sucai.com/">中老年服装</a>
                                        <a target="_blank" href="http://www.17sucai.com/">针织衫</a>
                                        <a target="_blank" href="http://www.17sucai.com/">T恤</a>
                                        <a target="_blank" href="http://www.17sucai.com/">卫衣</a>
                                        <a target="_blank" href="http://www.17sucai.com/">半身裙</a>
                                        <a target="_blank" href="http://www.17sucai.com/">皮草</a>
                                        <a target="_blank" href="http://www.17sucai.com/">婚纱/礼服/旗袍</a>
                                        <a target="_blank" href="http://www.17sucai.com/">真皮皮衣</a>
                                        <a target="_blank" href="http://www.17sucai.com/">衬衫</a>
                                        <a target="_blank" href="http://www.17sucai.com/">风衣</a>
                                        <a target="_blank" href="http://www.17sucai.com/">婚纱</a>
                                    </p>
                                    <h4 class="subItem-title brandTitle">品牌：</h4>
                                    <p class="subItem-brand">
                                        <a target="_blank" href="http://www.17sucai.com/">波司登</a>
                                        <a target="_blank" href="http://www.17sucai.com/">ochirly</a>
                                        <a target="_blank" href="http://www.17sucai.com/">韩都衣舍</a>
                                        <a target="_blank" href="http://www.17sucai.com/">裂帛</a>
                                        <a target="_blank" href="http://www.17sucai.com/">优衣库</a>
                                        <a target="_blank" href="http://www.17sucai.com/">only</a>
                                        <a target="_blank" href="http://www.17sucai.com/">秋水伊人</a>
                                        <a target="_blank" href="http://www.17sucai.com/">哥弟</a>
                                        <a target="_blank" href="http://www.17sucai.com/">粉红大布娃娃</a>
                                        <a target="_blank" href="http://www.17sucai.com/">三彩</a>
                                        <a target="_blank" href="http://www.17sucai.com/">歌莉娅</a>
                                        <a target="_blank" href="http://www.17sucai.com/">茵曼</a>
                                        <a target="_blank" href="http://www.17sucai.com/">艾莱依</a>
                                        <a target="_blank" href="http://www.17sucai.com/">衣香丽影</a>
                                        <a target="_blank" href="http://www.17sucai.com/">江南布衣</a>
                                        <a target="_blank" href="http://www.17sucai.com/">纳纹</a>
                                        <a target="_blank" href="http://www.17sucai.com/">播</a>
                                        <a target="_blank" href="http://www.17sucai.com/">香影</a>
                                        <a target="_blank" href="http://www.17sucai.com/">雅鹿</a>
                                        <a target="_blank" href="http://www.17sucai.com/">OSA</a>
                                    </p>
                                </li>
                                <li class="subItem">
                                    <h3 class="subItem-hd"><a target="_blank" href="http://www.17sucai.com/">服饰配件</a></h3>
                                    <p class="subItem-cat">
                                        <a target="_blank" href="http://www.17sucai.com/">女士丝巾/围巾/披肩</a>
                                        <a target="_blank" href="http://www.17sucai.com/">男士皮带</a>
                                        <a target="_blank" href="http://www.17sucai.com/">女士腰带</a>
                                        <a target="_blank" href="http://www.17sucai.com/">毛线</a>
                                        <a target="_blank" href="http://www.17sucai.com/">手套</a>
                                        <a target="_blank" href="http://www.17sucai.com/">帽子</a>
                                        <a target="_blank" href="http://www.17sucai.com/">男士围巾</a>
                                        <a target="_blank" href="http://www.17sucai.com/">领带/领结</a>
                                    </p>
                                    <h4 class="subItem-title brandTitle">品牌：</h4>
                                    <p class="subItem-brand">
                                        <a target="_blank" href="http://www.17sucai.com/">七匹狼</a>
                                        <a target="_blank" href="http://www.17sucai.com/">Rayli</a>
                                        <a target="_blank" href="http://www.17sucai.com/">CARTELO</a>
                                    </p>
                                </li>
                            </ul>

                            <ul>
                                <li class="subItem">
                                    <h3 class="subItem-hd"><a target="_blank" href="http://www.17sucai.com/">精品男装</a></h3>
                                    <p class="subItem-cat">
                                        <a target="_blank" href="http://www.17sucai.com/">羽绒服</a>
                                        <a target="_blank" href="http://www.17sucai.com/">毛衣</a>
                                        <a target="_blank" href="http://www.17sucai.com/">棉衣</a>
                                        <a target="_blank" href="http://www.17sucai.com/">皮衣</a>
                                        <a target="_blank" href="http://www.17sucai.com/">牛仔裤</a>
                                        <a target="_blank" href="http://www.17sucai.com/">呢大衣</a>
                                        <a target="_blank" href="http://www.17sucai.com/">风衣</a>
                                        <a target="_blank" href="http://www.17sucai.com/">夹克</a>
                                        <a target="_blank" href="http://www.17sucai.com/">羊绒衫</a>
                                        <a target="_blank" href="http://www.17sucai.com/">休闲裤</a>
                                        <a target="_blank" href="http://www.17sucai.com/">卫衣</a>
                                        <a target="_blank" href="http://www.17sucai.com/">马甲/背心</a>
                                        <a target="_blank" href="http://www.17sucai.com/">衬衫</a>
                                        <a target="_blank" href="http://www.17sucai.com/">t恤</a>
                                        <a target="_blank" href="http://www.17sucai.com/">针织衫</a>
                                        <a target="_blank" href="http://www.17sucai.com/">皮裤</a>
                                        <a target="_blank" href="http://www.17sucai.com/">西服</a>
                                        <a target="_blank" href="http://www.17sucai.com/">西裤</a>
                                        <a target="_blank" href="http://www.17sucai.com/">西服套装</a>
                                        <a target="_blank" href="http://www.17sucai.com/">中老年服装</a>
                                    </p>
                                    <h4 class="subItem-title brandTitle">品牌：</h4>
                                    <p class="subItem-brand">
                                        <a target="_blank" href="http://www.17sucai.com/">七匹狼</a>
                                        <a target="_blank" href="http://www.17sucai.com/">JACKJONES</a>
                                        <a target="_blank" href="http://www.17sucai.com/">太平鸟</a>
                                        <a target="_blank" href="http://www.17sucai.com/">GXG</a>
                                        <a target="_blank" href="http://www.17sucai.com/">恒源祥</a>
                                        <a target="_blank" href="http://www.17sucai.com/">劲霸</a>
                                        <a target="_blank" href="http://www.17sucai.com/">马克华菲</a>
                                        <a target="_blank" href="http://www.17sucai.com/">九牧王</a>
                                        <a target="_blank" href="http://www.17sucai.com/">利郎</a>
                                        <a target="_blank" href="http://www.17sucai.com/">LEE</a>
                                        <a target="_blank" href="http://www.17sucai.com/">柒牌</a>
                                        <a target="_blank" href="http://www.17sucai.com/">LEVI'S</a>
                                        <a target="_blank" href="http://www.17sucai.com/">SELECTED</a>
                                        <a target="_blank" href="http://www.17sucai.com/">杉杉</a>
                                        <a target="_blank" href="http://www.17sucai.com/">雅戈尔</a>
                                        <a target="_blank" href="http://www.17sucai.com/">DICKIES</a>
                                        <a target="_blank" href="http://www.17sucai.com/">诺帝卡</a>
                                        <a target="_blank" href="http://www.17sucai.com/">报喜鸟</a>
                                    </p>
                                </li>
                                <li class="subItem">
                                    <h3 class="subItem-hd"><a target="_blank" href="http://www.17sucai.com/">时尚家居</a></h3>
                                    <p class="subItem-cat">
                                        <a target="_blank" href="http://www.17sucai.com/">睡衣套装</a>
                                        <a target="_blank" href="http://www.17sucai.com/">夹棉家居服</a>
                                        <a target="_blank" href="http://www.17sucai.com/">珊瑚绒家居服</a>
                                        <a target="_blank" href="http://www.17sucai.com/">情侣套装</a>
                                        <a target="_blank" href="http://www.17sucai.com/">卡通睡衣</a>
                                        <a target="_blank" href="http://www.17sucai.com/">睡袍</a>
                                        <a target="_blank" href="http://www.17sucai.com/">睡裙</a>
                                        <a target="_blank" href="http://www.17sucai.com/">睡裤</a>
                                    </p>
                                    <h4 class="subItem-title brandTitle">品牌：</h4>
                                    <p class="subItem-brand">
                                        <a target="_blank" href="http://www.17sucai.com/">芬腾</a>
                                        <a target="_blank" href="http://www.17sucai.com/">安之伴</a>
                                        <a target="_blank" href="http://www.17sucai.com/">派邦奴</a>
                                        <a target="_blank" href="http://www.17sucai.com/">秋鹿</a>
                                        <a target="_blank" href="http://www.17sucai.com/">睦隆世家</a>
                                        <a target="_blank" href="http://www.17sucai.com/">雪俐</a>
                                        <a target="_blank" href="http://www.17sucai.com/">爱帝</a>
                                        <a target="_blank" href="http://www.17sucai.com/">美梦</a>
                                    </p>
                                </li>
                            </ul>

                            <ul>
                                <li class="subItem">
                                    <h3 class="subItem-hd"><a target="_blank" href="http://www.17sucai.com/">精致内衣</a></h3>
                                    <p class="subItem-cat">
                                        <a target="_blank" href="http://www.17sucai.com/">保暖套装</a>
                                        <a target="_blank" href="http://www.17sucai.com/">保暖上衣</a>
                                        <a target="_blank" href="http://www.17sucai.com/">精品文胸</a>
                                        <a target="_blank" href="http://www.17sucai.com/">塑身衣</a>
                                        <a target="_blank" href="http://www.17sucai.com/">女式内裤</a>
                                        <a target="_blank" href="http://www.17sucai.com/">文胸套装</a>
                                        <a target="_blank" href="http://www.17sucai.com/">中筒袜</a>
                                        <a target="_blank" href="http://www.17sucai.com/">连裤袜</a>
                                        <a target="_blank" href="http://www.17sucai.com/">男式内裤</a>
                                        <a target="_blank" href="http://www.17sucai.com/">保暖裤</a>
                                        <a target="_blank" href="http://www.17sucai.com/">聚拢文胸</a>
                                        <a target="_blank" href="http://www.17sucai.com/">美腿袜</a>
                                    </p>
                                    <h4 class="subItem-title brandTitle">品牌：</h4>
                                    <p class="subItem-brand">
                                        <a target="_blank" href="http://www.17sucai.com/">七匹狼</a>
                                        <a target="_blank" href="http://www.17sucai.com/">浪莎</a>
                                        <a target="_blank" href="http://www.17sucai.com/">波司登</a>
                                        <a target="_blank" href="http://www.17sucai.com/">南极人</a>
                                        <a target="_blank" href="http://www.17sucai.com/">恒源祥</a>
                                        <a target="_blank" href="http://www.17sucai.com/">北极绒</a>
                                        <a target="_blank" href="http://www.17sucai.com/">爱慕</a>
                                        <a target="_blank" href="http://www.17sucai.com/">曼妮芬</a>
                                        <a target="_blank" href="http://www.17sucai.com/">歌瑞尔</a>
                                        <a target="_blank" href="http://www.17sucai.com/">古今</a>
                                        <a target="_blank" href="http://www.17sucai.com/">猫人</a>
                                        <a target="_blank" href="http://www.17sucai.com/">安莉芳</a>
                                        <a target="_blank" href="http://www.17sucai.com/">夏娃之秀</a>
                                        <a target="_blank" href="http://www.17sucai.com/">黛安芬</a>
                                        <a target="_blank" href="http://www.17sucai.com/">金三塔</a>
                                    </p>
                                </li>
                                <p class="subItemAd">
                                    <a target="_blank" href="http://www.17sucai.com/"><img width="218" height="32" alt="潮流服饰精选" src="http://img04.taobaocdn.com/tps/i4/T1dVzWXbpjXXb12rTm-218-32.png"></a>
                                </p>
                            </ul>
                        </div>
                        <div class="subView">4、化妆品</div>
                        <div class="subView">5、运动户外</div>
                        <div class="subView">6、手机数码</div>
                        <div class="subView">7、家用电器</div>
                        <div class="subView">8、家具建材</div>
                        <div class="subView">9、家纺/居家</div>
                        <div class="subView">10、母婴玩具</div>
                        <div class="subView">11、食品</div>
                        <div class="subView">12、医药保健</div>
                        <div class="subView">13、汽车配件</div>
                        <div class="subView">14、图书音像</div>
                        <div class="subView">15、文化娱乐</div>
                        <div class="subView">16、手机/网游点卡</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="banner">
                    <div class="banner-btn">
                        <a href="javascript:;" class="prevBtn"><i></i></a>
                        <a href="javascript:;" class="nextBtn"><i></i></a>
                    </div>
                    <ul class="banner-img">
                        <li><a href="#"><img src="https://gw.alicdn.com/tps/TB1lK1PLpXXXXcDXFXXXXXXXXXX-714-398.jpg_790x10000q90.jpg" ></a></li>
                        <li><a href="#"><img src="public/common/images/002.jpg" ></a></li>
                        <li><a href="#"><img src="public/common/images/003.jpg" ></a></li>
                        <li><a href="#"><img src="public/common/images/004.jpg" ></a></li>
                        <li><a href="#"><img src="public/common/images/005.jpg" ></a></li>
                        <li><a href="#"><img src="public/common/images/006.jpg" ></a></li>
                        <li><a href="#"><img src="public/common/images/006.jpg" ></a></li>
                        <li><a href="#"><img src="public/common/images/006.jpg" ></a></li>
                    </ul>
                    <ul class="banner-circle"></ul>
                </div>
                </div>
            </div>

        <div class="row">
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
<?php
    $this->registerJsFile('public/common/menu/js/jquery.tmailsider.js',
        ['depends' => [JqueryAsset::className()],'position'=>$this::POS_END]
    );
?>

<?php $this->beginBlock('jquery') ?>

    $('#Z_TypeList').Z_TMAIL_SIDER({
        target : $(".banner")
    });

    $(function(){
        var $banner=$('.banner');
        var $banner_ul=$('.banner-img');
        var $btn=$('.banner-btn');
        var $btn_a=$btn.find('a')
        var v_width=$banner.width();

        var page=1;

        var timer=null;
        var btnClass=null;

        var page_count=$banner_ul.find('li').length;//把这个值赋给小圆点的个数

        var banner_cir="<li class='selected' href='#'><a></a></li>";
        for(var i=1;i<page_count;i++){
            //动态添加小圆点
            banner_cir+="<li><a href='#'></a></li>";
        }
        $('.banner-circle').append(banner_cir);

        var cirLeft=$('.banner-circle').width()*(-0.5);
        $('.banner-circle').css({'marginLeft':cirLeft});

        $banner_ul.width(page_count*v_width);

        function move(obj,classname){
            //手动及自动播放
            if(!$banner_ul.is(':animated')){
                if(classname=='prevBtn'){
                    if(page==1){
                        $banner_ul.animate({left:-v_width*(page_count-1)});
                        page=page_count;
                        cirMove();
                    }
                    else{
                        $banner_ul.animate({left:'+='+v_width},"slow");
                        page--;
                        cirMove();
                    }
                }
                else{
                    if(page==page_count){
                        $banner_ul.animate({left:0});
                        page=1;
                        cirMove();
                    }
                    else{
                        $banner_ul.animate({left:'-='+v_width},"slow");
                        page++;
                        cirMove();
                    }
                }
            }
        }

        function cirMove(){
            //检测page的值，使当前的page与selected的小圆点一致
            $('.banner-circle li').eq(page-1).addClass('selected')
                .siblings().removeClass('selected');
        }

        $banner.mouseover(function(){
            $btn.css({'display':'block'});
            clearInterval(timer);
        }).mouseout(function(){
            $btn.css({'display':'none'});
            clearInterval(timer);
            timer=setInterval(move,3000);
        }).trigger("mouseout");//激活自动播放

        $btn_a.mouseover(function(){
            //实现透明渐变，阻止冒泡
            $(this).animate({opacity:0.6},'fast');
            $btn.css({'display':'block'});
            return false;
        }).mouseleave(function(){
            $(this).animate({opacity:0.3},'fast');
            $btn.css({'display':'none'});
            return false;
        }).click(function(){
            //手动点击清除计时器
            btnClass=this.className;
            clearInterval(timer);
            timer=setInterval(move,3000);
            move($(this),this.className);
        });

        $(document.body).on('click','.banner-circle li',function(){
            var index=$('.banner-circle li').index(this);
            $banner_ul.animate({left:-v_width*index},'slow');
            page=index+1;
            cirMove();
        });
    });
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['jquery'], \yii\web\View::POS_END); ?>

