<?php

/* @var $this yii\web\View */

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
    .banner{ width: 1120px; height: 400px; position: relative; overflow: hidden; margin-bottom: 0; margin-left: auto; margin-right: auto; margin-top: 10px; }
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
<div class="site-index">

    <!--<div class="jumbotron">
        <h1>Welcome To ZCshop</h1>
        <p class="lead">ZCshop基于YII2.0框架开发的一套商城系统，相对于其他系统，它具有高效，稳定，安全的优势</p>
        <p><a class="btn btn-lg btn-success" href="<?/*= Yii::$app->urlManager->createUrl(['goods/list', 'cid' => 4])*/?>">ZC商城系统</a></p>
    </div>-->

    <div class="body-content">

        <div class="banner">
            <div class="banner-btn">
                <a href="javascript:;" class="prevBtn"><i></i></a>
                <a href="javascript:;" class="nextBtn"><i></i></a>
            </div>
            <ul class="banner-img">
                <li><a href="#"><img src="https://gw.alicdn.com/tps/TB1lK1PLpXXXXcDXFXXXXXXXXXX-714-398.jpg_790x10000q90.jpg" width="1120" height="400"></a></li>
                <li><a href="#"><img src="public/common/images/002.jpg" width="1120" height="400"></a></li>
                <li><a href="#"><img src="public/common/images/003.jpg" width="1120" height="400"></a></li>
                <li><a href="#"><img src="public/common/images/004.jpg" width="1120" height="400"></a></li>
                <li><a href="#"><img src="public/common/images/005.jpg" width="1120" height="400"></a></li>
                <li><a href="#"><img src="public/common/images/006.jpg" width="1120" height="400"></a></li>
                <li><a href="#"><img src="public/common/images/006.jpg" width="1120" height="400"></a></li>
                <li><a href="#"><img src="public/common/images/006.jpg" width="1120" height="400"></a></li>
            </ul>
            <ul class="banner-circle"></ul>
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
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['jquery'], \yii\web\View::POS_END); ?>

