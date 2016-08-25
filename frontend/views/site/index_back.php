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
<?= Html::cssFile('public/frontend/css/head.css')?>
<?= Html::cssFile('public/common/menu/css/main.css')?>
<div class="site-index">

    <!--<div class="jumbotron">
        <h1>Welcome To ZCshop</h1>
        <p class="lead">ZCshop基于YII2.0框架开发的一套商城系统，相对于其他系统，它具有高效，稳定，安全的优势</p>
        <p><a class="btn btn-lg btn-success" href="<?/*= Yii::$app->urlManager->createUrl(['goods/list', 'cid' => 4])*/?>">ZC商城系统</a></p>
    </div>-->

    <div class="body-content">
        <div class="row">
            <div class="col-lg-3">
                <div class="hc_lnav jslist">
                    <div class="allbtn">
                        <h2><a href="#"><strong>&nbsp;</strong>全部商品分类<i>&nbsp;</i></a></h2>
                        <ul style="width:290px" class="jspop box">
                            <li class=a1>
                                <div class=tx><a href="#"><i>&nbsp;</i>各地名优茶</a> </div>
                                <dl>
                                    <dt>热门</dt>
                                    <dd>
                                        <a href="#">西湖龙井</a>
                                        <a href="#">金骏眉</a>
                                        <a href="#">大红袍</a>
                                        <a href="#">铁观音</a>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>名茶</dt>
                                    <dd>
                                        <a href="#">红茶</a>
                                        <a href="#">绿茶</a>
                                        <a href="#">乌龙茶</a>
                                        <a href="#">黑茶</a>
                                        <a href="#">白茶 </a>
                                    </dd>
                                </dl>
                                <div class=pop>
                                    <h3><a href="#">各地名优茶</a></h3>
                                    <dl>
                                        <dl>
                                            <dt>绿茶</dt>
                                            <dd>
                                                <a class="ui-link" href="#">西湖龙井</a>
                                                <a class="ui-link"  href="#">龙井</a>
                                                <a class="ui-link" href="#">黄山毛峰</a>
                                                <a class="ui-link"   href="#">安吉白茶</a>
                                                <a class="ui-link" href="#">其他绿茶</a>
                                            </dd>
                                        </dl>
                                        <dl>
                                            <dt>乌龙茶</dt>
                                            <dd>
                                                <a class="ui-link" href="">铁观音</a>
                                                <a class="ui-link"  href="">大红袍</a>
                                                <a class="ui-link" href="">水仙</a>
                                                <a class="ui-link"  href="">肉桂</a>
                                                <a class="ui-link" href="">台湾乌龙</a>
                                                <a class="ui-link" href="">其他乌龙茶</a>
                                            </dd>
                                        </dl>
                                        <dl>
                                            <dt>红茶</dt>
                                            <dd>
                                                <a class="ui-link" href="" >金骏眉</a>
                                                <a class="ui-link"  href="">正山小种</a>
                                                <a class="ui-link"  href="">祁门红茶</a>
                                                <a class="ui-link"   href="">坦洋工夫</a>
                                                <a class="ui-link" href="javascript:;">其他红茶</a>
                                                <a class="un ui-link"    href="">政和工夫</a>
                                                <a class="ui-link"   href="">滇红工夫</a>
                                            </dd>
                                        </dl>
                                        <dl>
                                            <dt>黑茶</dt>
                                            <dd>
                                                <a class="ui-link" href="">白沙溪黑茶</a>
                                                <a class="ui-link"  href="">普洱茶饼</a>
                                                <a class="ui-link" href="">普洱沱茶</a>
                                                <a class="ui-link"  href="">普洱茶砖</a>
                                                <a class="ui-link"  href="">普洱散茶</a>
                                                <a class="ui-link" href="">其他黑茶</a>
                                            </dd>
                                        </dl>
                                        <dl>
                                            <dt>白茶</dt>
                                            <dd>
                                                <a class="ui-link" href="#">白牡丹</a>
                                                <a class="ui-link"  href="">白毫银针</a>
                                                <a class="ui-link" href="">寿眉</a>
                                                <a class="ui-link" href="">其他白茶</a>
                                            </dd>
                                        </dl>
                                    </dl>
                                    <dl>
                                        <dt>品牌</dt>
                                        <dd>
                                            <a  href="">滋恩</a>
                                            <a  href="">远荣</a>
                                            <a  href="">顶峰</a>
                                            <a  href="">公泰</a>
                                            <a  href="">一品堂</a>
                                            <a  href="">好吉</a>
                                            <a   href="">绿雪芽</a>
                                            <a  href="">台湾梅山制茶</a>
                                            <a href="" >白沙溪</a>
                                            <a href="">联兴茶叶</a>
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt>价格</dt>
                                        <dd>
                                            <a  href="">100元及以下</a>
                                            <a  href="">100-300元</a>
                                            <a  href="">300元及以上</a>
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt>净含量</dt>
                                        <dd>
                                            <a  href="" >50g及以下</a>
                                            <a   href="">51-100g</a>
                                            <a  href="">101-250g</a>
                                            <a   href="">250g以上</a>
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt>包装</dt>
                                        <dd>
                                            <a href="">经济自饮装</a>
                                            <a href="" >精美礼品装</a>
                                        </dd>
                                    </dl>
                                    <div class=clr></div>
                                    <div class=act><a href=""><img src="public/common/menu/images/20150518092317.jpg" /></a> </div>
                                </div>
                            </li>
                            <li class=a2>
                                <div class=tx><a href=""><i>&nbsp;</i>花草保健茶</a> </div>
                                <dl>
                                    <dt>推荐</dt>
                                    <dd>
                                        <a href="">大麦茶</a>
                                        <a href="">苦荞茶</a>
                                        <a href="" >玫瑰花茶</a>
                                        <a href="">雪菊</a>
                                        <a href="" >蜂蜜木瓜粉</a>
                                    </dd>
                                </dl>
                                <div class=pop>
                                    <h3><a href="">花草保健茶</a></h3>
                                    <dl>
                                        <dl>
                                            <dt>瘦身</dt>
                                            <dd>
                                                <a class="ui-link" href="" >玫瑰荷叶茶</a>
                                                <a class="ui-link"    href="">玄米茶</a>
                                                <a  class="ui-link" href="">兰香子</a>
                                                <a class="ui-link"   href="" >纤维泡腾片</a>
                                                <a class="ui-link"   href="" >青梅苹果酸</a>
                                                <a class="ui-link"   href="">三草茶</a>
                                            </dd>
                                        </dl>
                                        <dl>
                                            <dt>美容</dt>
                                            <dd>
                                                <a class="ui-link" href="" >法兰西玫瑰</a>
                                                <a class="ui-link"  href=""  >冻干柠檬片</a>
                                                <a class="un ui-link"   href="">果粒茶</a>
                                                <a    class="ui-link" href="" >大麦茶</a>
                                                <a class="ui-link"   href="">蜂蜜抹茶粉</a>
                                            </dd>
                                        </dl>
                                        <dl>
                                            <dt>丰胸</dt>
                                            <dd>
                                                <a class="ui-link" href="" >木瓜葛根粉</a>
                                                <a class="ui-link"    href=""  >蜂蜜木瓜粉</a>
                                                <a class="ui-link"   href="">红酒木瓜丽人饮</a>
                                            </dd>
                                        </dl>
                                    </dl>
                                    <dl>
                                        <dt>品牌</dt>
                                        <dd>
                                            <a href="">与花香</a>
                                            <a href="">美丽快攻</a>
                                            <a href="" >顶峰</a>
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt>价格</dt>
                                        <dd>
                                            <a href="" >100元及以下</a>
                                            <a   href="" >100-300元</a>
                                            <a  href="">300元及以上</a>
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt>净含量</dt>
                                        <dd>
                                            <a href="">50g及以下</a>
                                            <a href="">51-100g</a>
                                            <a href="">101-250g</a>
                                            <a href="">250g以上</a>
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt>包装</dt>
                                        <dd>
                                            <a href="">经济自饮装</a>
                                            <a href="">精美礼品装</a>
                                        </dd>
                                    </dl>
                                    <div class=clr></div>
                                    <div class=act><a href=""><img src="public/common/menu/images/20150518092236.jpg" /></a></div>
                                </div>
                            </li>
                            <li class=a3>
                                <div class=tx><a href=""><i>&nbsp;</i>精选茶具</a> </div>
                                <dl>
                                    <dt>推荐</dt>
                                    <dd>
                                        <a href="" >功夫茶具</a>
                                        <a href="">个人杯</a>
                                        <a href="">茶宠</a>
                                        <a href="">茶叶罐</a>
                                    </dd>
                                </dl>
                                <div class=pop>
                                    <h3><a href="">精选茶具</a></h3>
                                    <dl>
                                        <dl>
                                            <dt>陶瓷</dt>
                                            <dd>
                                                <a class="ui-link" href="">茶叶罐</a>
                                                <a class="ui-link"  href="">功夫茶具</a>
                                                <a class="ui-link" href="" >茶壶</a>
                                                <a class="ui-link"  href="">茶宠</a>
                                                <a class="ui-link" href=""  >茶杯</a>
                                                <a class="ui-link"  href="">茶具礼盒</a>
                                            </dd>
                                        </dl>
                                    </dl>
                                    <dl>
                                        <dt>品牌</dt>
                                        <dd>
                                            <a  href="">恒越</a>
                                            <a  href="">卓越</a>
                                            <a   href="">国尊陶瓷</a>
                                            <a  href="">宏远达</a>
                                            <a href="">福万利</a>
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt>价格</dt>
                                        <dd>
                                            <a href="">100元及以下</a>
                                            <a  href="">100-300元</a>
                                            <a  href="">300元及以上</a>
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt>包装</dt>
                                        <dd>
                                            <a href="">经济自饮装</a>
                                            <a  href="">精美礼品装</a>
                                        </dd>
                                    </dl>
                                    <div class=clr></div>
                                    <div class=act><a href=""><img src="public/common/menu/images/20150518092152.jpg" /></a></div>
                                </div>
                            </li>
                            <li class=a4>
                                <div class=tx><a href=""><i>&nbsp;</i>可口茶食</a> </div>
                                <dl>
                                    <dt>推荐</dt>
                                    <dd>
                                        <a href="">橄榄</a>
                                        <a   href="">冰糖杨梅</a>
                                        <a  href="">酸甜梅</a>
                                    </dd>
                                </dl>
                                <div class=pop>
                                    <h3><a href="">可口茶食</a></h3>
                                    <dl>
                                        <dl>
                                            <dt>干果</dt>
                                            <dd>
                                                <a class="ui-link" href="">杏仁</a>
                                                <a class="ui-link"   href="">瓜子</a>
                                                <a  class="un ui-link" href="">开心果</a>
                                            </dd>
                                        </dl>
                                        <dl>
                                            <dt>零食</dt>
                                            <dd>
                                                <a class="ui-link"  href="">水晶柠檬片</a>
                                                <a class="ui-link"  href="">方块酥</a>
                                                <a class="ui-link" href="javascript:;">凤梨酥</a>
                                                <a  class="ui-link" href="">燕麦巧克力</a>
                                            </dd>
                                        </dl>
                                    </dl>
                                    <dl>
                                        <dt>品牌</dt>
                                        <dd>
                                            <a href="">赛园</a>
                                            <a  href="">新味</a>
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt>价格</dt>
                                        <dd>
                                            <a  href="">100元及以下</a>
                                            <a  href="">100-300元</a>
                                            <a  href="">300元及以上</a>
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt>净含量</dt>
                                        <dd>
                                            <a  href="" >50g及以下</a>
                                            <a   href="">51-100g</a>
                                            <a  href="">101-250g</a>
                                            <a  href="">250g以上</a>
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt>包装</dt>
                                        <dd>
                                            <a  href="">经济自饮装</a>
                                            <a   href="">精美礼品装</a>
                                        </dd>
                                    </dl>
                                    <div class=clr></div>
                                    <div class=act><a href=""><img src="public/common/menu/images/20150518092213.jpg" /></a> </div>
                                </div>
                            </li>
                        </ul>
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
                        <li><a href="#"><img src="https://gw.alicdn.com/tps/TB1lK1PLpXXXXcDXFXXXXXXXXXX-714-398.jpg_790x10000q90.jpg" width="906px" ></a></li>
                        <li><a href="#"><img src="public/common/images/002.jpg" width="906px"></a></li>
                        <li><a href="#"><img src="public/common/images/003.jpg" width="906px"></a></li>
                        <li><a href="#"><img src="public/common/images/004.jpg" width="906px"></a></li>
                        <li><a href="#"><img src="public/common/images/005.jpg" width="906px"></a></li>
                        <li><a href="#"><img src="public/common/images/006.jpg" width="906px"></a></li>
                        <li><a href="#"><img src="public/common/images/006.jpg" width="906px"></a></li>
                        <li><a href="#"><img src="public/common/images/006.jpg" width="906px"></a></li>
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
    /*$this->registerJsFile('public/common/menu/js/jquery.tmailsider.js',
        ['depends' => [JqueryAsset::className()],'position'=>$this::POS_END]
    );*/
?>

<?php $this->beginBlock('jquery') ?>

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
</script>
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['jquery'], \yii\web\View::POS_END); ?>

