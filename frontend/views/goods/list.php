<?php
use yii\bootstrap\Html;

$curCategory = array_pop($parentCats);
$this->title = $curCategory['name'];

foreach ((array)$parentCats as $cat) {
    $this->params['breadcrumbs'][] = ['label' => $cat['name'], 'url' => ['goods/cats', 'cid' => $cat['id']]];
}
$this->params['breadcrumbs'][] = $curCategory['name'];

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
</style>
<div class="site-index">

    <!--属性值选择 start-->
    <div class="body-content" id="attr-vals" style="background-color: #ffffff; padding: 10px 10px;"></div>
    <!--属性值选择 end-->

    <div class="body-content">
        <div class="row">
            <div class="col-lg-2">
                <div class="row" style="margin: 15px 0px">
                    <div class="">相关推荐</div>
                </div>
                <div id="recommend-goods" style="padding:0px 3px;border: 1px solid #DDDDDD"></div>
            </div>
            <div class="col-lg-10">
                <div class="row" style="width: 100%;margin: 15px 0px;">
                    <div class="col-lg-4">相关商品&nbsp;<strong id="list-total" style="color: orange">?</strong>&nbsp;个</div>
                    <div class="col-lg-8 text-right goods-order">排序：
                        <a class="btn btn-danger btn-xs" href="#" data-order="time" role="button">上架时间</a>
                        <a class="btn btn-xs" href="#" data-order="sale" role="button">销量</a>
                        <a class="btn btn-xs" href="#" data-order="price" role="button">价格</a>
                        <a class="btn btn-xs" href="#" data-order="comment" role="button">评论数</a>
                    </div>
                </div>
                <div class="row" id="goods-list">
                    <div class="col-sm-6 col-md-3 hide">
                        <div class="thumbnail">
                            <img src="http://img14.360buyimg.com/n7/jfs/t718/254/983764544/122272/4f92a813/55104384N087402f7.jpg"
                                 alt="通用的占位符缩略图">
                            <div class="caption">
                                <h3 style="color: #E4393C">¥133.00</h3>
                                <p><a href="#" style="color: #333333"><strong style="color: orange">森马水洗牛仔裤</strong> 2016夏装新款 女士低腰字母背带裤牛仔长裤潮 牛仔中蓝0820 L</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="float: right">
                    <div class="col-sm-6 col-md-12" id="result-page"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/html" id="productTemplate">
    <div class="col-sm-6 col-md-3">
        <div class="thumbnail">
            <img  src="<%=ad_img%>" alt="<%=name%>" style="height: 240px;width: 240px">
            <div class="caption" ">
                <h3 style="color: #E4393C">¥<%=sell_price%> <small><del>¥<%=market_price%></del></small></h3>
                <p style="height: 60px;overflow-y: hidden"><a href="<?= Yii::$app->urlManager->createUrl(['goods/detail'])?>&id=<%=id%>" style="color: #333333"><%=name%></a></p>
            </div>
        </div>
    </div>
</script>

<script type="text/html" id="recommendTemplate">
    <% for (var i = 0,  len = list.length; i < len; i++) { %>
    <div class="" style="width: 100%;">
        <div class="thumbnail" style="border: #ffffff">
            <img src="<%=list[i].ad_img%>" alt="<%=list[i].name%>">
            <div class="caption">
                <h3 style="color: #E4393C">¥<%=list[i].sell_price%></h3>
                <p><a href="<?= Yii::$app->urlManager->createUrl(['goods/detail'])?>&id=<%=list[i].id%>" style="color: #333333"><%=list[i].name%></a></p>
            </div>
        </div>
    </div>
    <% } %>
</script>

<script type="text/html" id="attrValTemplate">
    <% for (var i = 0,  len = list.length; i < len; i++) { %>
    <div class="row" style="margin-bottom: 5px;">
        <div class="col-lg-1 text-right">
            <a class="btn btn-xs" href="#" role="button"><%=list[i].name%>：</a>
        </div>
        <div class="col-lg-11" style="padding-left:0px">
            <a class="btn btn-danger attr-select" href="#" role="button">全部</a>
            <% var attr_val = list[i].value || [];  %>
            <% for (var j = 0, len2 = attr_val.length; j < len2; j++) { %>
            <a class="btn attr-select" href="#" role="button" data-i="<%=attr_val[j].id%>"><%=attr_val[j].name%></a>
            <% } %>
        </div>
    </div>
    <% } %>
</script>

<?= Html::jsFile('public/common/js/upload-page.js'); ?>
<?= Html::jsFile('public/common/js/template.js'); ?>

<?php $this->beginBlock('jquery') ?>

    $(function() {

        var cid = <?= intval($_GET['cid']); ?>;
        var sort = <?= SORT_ASC; ?>;

        var reajax = null;
        var page = null;
        function getResourcesHandle(pa) {
            var $list = $("#goods-list");
            var val = $("#searchForm_keyWord").val();
            var key_Word = val;
            if (key_Word == "" || key_Word == "请输入关键字") {
                key_Word = "";
            }
            var len = pa.len;                   // 获取分页长度
            var cur = pa.start;                 // 获取第几页
            var data = getConditions();         // 获取大部分搜索条件
            data.cid = cid;
            data.page = cur;
            data.pageSize = len;
            data.keyWord = key_Word;    // 获取关键字
            $list.html('<div class="col-sm-12 col-md-12"><article style="width:400px;margin: 150px auto;"><img src="public/common/images/loading.gif"><span style="font-size: 24px;margin-left: 20px;">正在加载中，请稍候...</span></article></div>');
            reajax && reajax.abort();           //取消上一个同等请求
            reajax = $.ajax({
                url: "<?= Yii::$app->urlManager->createUrl(['goods/ajax-list']);?>",
                type: "POST",
                dataType: "json",
                data: data,
                success: function(data) {
                    var list = data.data && data.data.list ? data.data.list : [];
                    // 设置分页
                    pa.page.setPage(data.data ? data.data.total || 0 : 0);
                    $("#list-total").text(data.data ? data.data.total || 0 : 0);
                    // 设置资源
                    var items = "";
                    for (var i = 0, leni = list.length; i < leni; i++) {
                        items += template.render("productTemplate", list[i]);
                    }
                    if (leni == 0) {
                        items = '<p class="text-center" style="font-size:24px;color:orange;height:300px;line-height:300px;">暂无商品！</p>';
                    }
                    $list.html(items);
                },
                error: function() {
                    reajax.statusText != "abort" && $list.html('<p class="f24 orange font-y tc" style="height:300px;line-height:300px;">暂无商品！</p>');
                }
            });
        }

        // 分页
        function getPage(params) {
            page = null;
            page = new UpLoadPage({
                len: 48,
                $el: $("#result-page"),
                callback: getResourcesHandle,
                params: params
            });
            page.init();
        }

        //搜索条件
        function getConditions() {
            var data = {
                vid : []
            };

            //属性值集合
            $("#attr-vals").children().find(".btn-danger").each(function(){
                data.vid.push($(this).data("i"));
            });

            //排序
            data.order = $(".goods-order").find(".btn-danger").data("order");

            //倒序正序
            if (sort == <?= SORT_DESC?>) {
                data.sort = <?= SORT_ASC?>;
                sort = <?= SORT_ASC?>;
            } else {
                data.sort = <?= SORT_DESC?>;
                sort = <?= SORT_DESC?>;
            }



            return data;
        }

        getPage();

        //属性值列表
        (function(){
            $.ajax({
                url : "<?= Yii::$app->urlManager->createUrl(['goods/get-attr-val-by-cid'])?>",
                dataType : "json",
                data : {cid : cid},
                type : "get",
                success : function (data){
                    var vals = data.data ? data.data : [];
                    var items = template.render("attrValTemplate", {list : vals});
                    if (vals.length == 0) {
                        $("#attr-vals").html("");
                    } else {
                        $("#attr-vals").html(items);
                    }
                }
            });
        })();

        //相关推荐
        (function(){
            $.ajax({
                url : "<?= Yii::$app->urlManager->createUrl(['goods/recommend-goods'])?>",
                dataType : "json",
                data : {cid : cid},
                type : "get",
                success : function (data){
                    var vals = data.data ? data.data : [];
                    var items = template.render("recommendTemplate", {list : vals});
                    if (vals.length == 0) {
                        $("#recommend-goods").html("");
                    } else {
                        $("#recommend-goods").html(items);
                    }
                }
            });
        })();

        //属性值选择
        $(document.body).on("click", ".attr-select", function(){
            $(this).addClass("btn-danger").siblings().removeClass("btn-danger");
            getPage();
        });

        //排序选择
        $(document.body).on("click", ".goods-order a", function(){
            $(this).addClass("btn-danger").siblings().removeClass("btn-danger");
            getPage();
        });


    });

<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['jquery'], \yii\web\View::POS_END); ?>



