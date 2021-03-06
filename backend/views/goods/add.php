<?php
use yii\helpers\Html;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>添加商品</title>
    <?= Html::cssFile('public/backend/css/bs3/dpl-min.css')?>
    <?= Html::cssFile('public/backend/css/bs3/bui-min.css')?>
    <?= Html::jsFile('public/common/js/jquery-1.8.1.min.js')?>
</head>
<style>
    .bui-tab-item{
        position: relative;

    }
    .bui-tab-item .bui-tab-item-text{
        padding-right: 25px;
    }

    .bui-tab-item .icon-remove{
        position: absolute;
        right: 2px;
        top:2px;
        z-index: 20;
        cursor: pointer;
    }
</style>
<body>
<div class="demo-content">

    <!-- 表单页 ================================================== -->
    <div class="row">
        <form id="J_Form" class="form-horizontal" method="post" action="<?= Yii::$app->urlManager->createUrl(['goods/add'])?>">
            <div id="tab-select">
                <ul>
                    <li class="bui-tab-panel-item active"><a href="#">基本信息</a></li>
                    <li class="bui-tab-panel-item"><a href="#">SEO设置</a></li>
                    <li class="bui-tab-panel-item"><a href="#">上传图集</a></li>
                </ul>
            </div>
            <div id="panel" class="">
                <!--标签一start-->
                <div id="p1">
                    <h3></h3>
                    <div class="control-group">
                        <label class="control-label"><s>*</s>商品名称：</label>
                        <div class="controls">
                            <input name="name" type="text" class="input-large" data-rules="{required : true}" value="商品测试啦">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label"><s>*</s>商品货号：</label>
                        <div class="controls">
                            <input name="goods_no" type="text" class="input-normal" data-rules="{required : true}" value="g13541242121">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label"><s>*</s>销售价格：</label>
                        <div class="controls">
                            <input name="sell_price" type="text" class="input-small" data-rules="{required : true}" value="20">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label"><s>*</s>市场价格：</label>
                        <div class="controls">
                            <input name="market_price" type="text" class="input-small" data-rules="{required : true}" value="26">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label"><s>*</s>成本价格：</label>
                        <div class="controls">
                            <input name="cost_price" type="text" class="input-small" data-rules="{required : true}" value="9">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">选择分类：</label>
                        <div class="controls bui-form-group-select" data-type="type1">
                            <select class="input-normal first-categories">
                                <option>--请选择--</option>
                            </select>&nbsp;&nbsp;
                            <select class="input-normal hide second-categories">
                                <option>--请选择--</option>
                            </select>
                            <select class="input-normal hide three-categories">
                                <option>--请选择--</option>
                            </select>
                            <input id="cid" name="cid" value="" type="hidden">
                        </div>
                    </div>
                    <div id="attr-select">
                        <!--<div class="control-group">
                            <label class="control-label">品牌：</label>
                            <div class="controls attr-val-list control-row-auto ">
                                <label class="checkbox"><input name="range" type="checkbox" value="1">范围1</label>
                                <label class="checkbox"><input name="range" type="checkbox" value="2">范围2</label>
                                <label class="checkbox"><input name="range" type="checkbox" value="3">范围3</label>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">适用人群：</label>
                            <div class="controls attr-val-list control-row-auto" >
                                <label class="checkbox"><input name="range" type="checkbox" value="1">范围1</label>
                                <label class="checkbox"><input name="range" type="checkbox" value="2">范围2</label>
                                <label class="checkbox"><input name="range" type="checkbox" value="3">范围3</label>
                            </div>
                        </div>-->
                    </div>

                    <!--<div class="control-group">
                        <label class="control-label"><s>*</s>货品来源：</label>
                        <div class="controls">
                            <select data-rules="{required:true}">
                                <option value="">-请选择-</option>
                                <option value="其他">其他</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label"><s>*</s>是否QC：</label>
                        <div class="controls">
                            <input type="radio" name="ismerge" value="是"> 是
                            <input type="radio" name="ismerge" value="否" checked="checked" > 否
                            <span class="auxiliary-text">默认“预计入仓时间”至少比“活动时间”早2天；如需QC，则“预计入仓时间”至少比“活动时间”早4天</span>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label"><s>*</s>活动时间：</label>
                        <div class="controls">
                            <input type="text" class="calendar" data-rules="{required:true}">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label"><s>*</s>预计入仓时间：</label>
                        <div class="controls">
                            <input type="text" class="calendar" data-rules="{required:true}">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label"><s>*</s>入仓类别：</label>
                        <div class="controls">
                            <select data-rules="{required:true}">
                                <option value="">-请选择-</option>
                                <option value="其他">其他</option>
                            </select>
                        </div>
                    </div>-->
                    <div class="control-group" style="clear: both">
                        <label class="control-label">上架时间：</label>
                        <div class="controls control-row-auto">
                            <label class="radio">
                                <input type="radio" name="is_del" value="3" checked="checked">立刻
                            </label>
                            <label  class="radio">
                                <input type="radio" name="is_del" value="0">稍后
                            </label>
                         </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">推荐类型：</label>
                        <div class="controls control-row-auto">
                            <label class="checkbox">
                                <input type="checkbox" value="1" name="recommend">最新商品
                            </label>
                            <label class="checkbox">
                                <input type="checkbox" value="2" checked="checked" name="recommend">特价商品
                            </label>
                            <label class="checkbox">
                                <input type="checkbox" value="3" checked="checked" name="recommend">热卖商品
                            </label>
                            <label class="checkbox">
                                <input type="checkbox" value="4" checked="checked" name="recommend">推荐商品
                            </label>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label"><s>*</s>主图：</label>
                        <div class="controls control-row-auto">
                            <div style="width: 100%;">
                                <div id="mainImgView"></div>
                            </div>
                        </div>
                    </div>
                    <?= \common\widgets\WangEditorWidget::widget(); ?>
                </div>
                <!--标签二start-->
                <div id="p2">
                    <h3></h3>
                    <div class="control-group">
                        <label class="control-label"><s>*</s>SEO关键字：</label>
                        <div class="controls">
                            <input name="keywords" type="text" class="input-large" VALUE="商品测试啦">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">SEO描述：</label>
                        <div class="controls control-row4">
                            <textarea type="text" id="description" class="input-large" data-valid="{}">商品测试啦</textarea>
                        </div>
                    </div>
                </div>
                <!--标签三start-->
                <div id="p3">
                    <h3></h3>
                    <div class="row">
                        <div style="width: 100%; padding-left: 50px">
                            <div id="J_Uploader">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="form-actions span5 offset3">
                <button id="submit-form" type="submit" class="button button-primary">提交</button>
            </div>
        </form>
    </div>
    <?= Html::jsFile('public/backend/js/bui-min.js')?>
    <?= Html::jsFile('public/backend/js/config2.js')?>

    <script type="text/javascript">
        BUI.use(['bui/form','bui/tab'],function  (Form,Tab) {

            new Form.Form({
                srcNode : '#J_Form'
            }).render();

            new Tab.TabPanel({
                srcNode : '#tab-select',
                elCls : 'nav-tabs',
                itemStatusCls : {
                    'selected' : 'active'
                },
                panelContainer : '#panel'//如果不指定容器的父元素，会自动生成
                //selectedEvent : 'mouseenter'//默认为click,可以更改事件
            }).render();

        });

        BUI.use('bui/uploader',function (Uploader) {

            //添加自定义主题
            Uploader.Theme.addTheme('imageView', {
                elCls: 'imageViewTheme',
                url: '<?= Yii::$app->urlManager->createUrl('attr/upload')?>',
                queue:{
                    resultTpl: {
                        'default': '<div class="default">{name}</div>',
                        'success': '<div class="success"><input class="ablum" name="photo" value="{url}" type="hidden"><img src="{url}" width="120px" height="120"/></div>',
                        'error': '<div class="error"><span class="uploader-error">{msg}</span></div>',
                        'progress': '<div class="progress"><div class="bar" style="width:{loadedPercent}%"></div></div>'
                    }
                }
            });

            var uploader = new Uploader.Uploader({
                theme: 'imageView',
                render: '#J_Uploader',
                rules: {
                    ext: ['.jpg,.jpeg,.png,.bmp','文件类型只能为{0}'],
                    maxSize: [2048, '文件大小不能大于2M']
                }
            }).render();
        });

        BUI.use('bui/uploader',function (Uploader) {

            //添加自定义主题
            Uploader.Theme.addTheme('mainImgView', {
                elCls: 'imageViewTheme',
                url: '<?= Yii::$app->urlManager->createUrl('attr/upload')?>',
                queue:{
                    resultTpl: {
                        'default': '<div class="default">{name}</div>',
                        'success': '<div class="success"><input class="ablum" name="mainImg" value="{url}" type="hidden"><img src="{url}" width="120px" height="120"/></div>',
                        'error': '<div class="error"><span class="uploader-error">{msg}</span></div>',
                        'progress': '<div class="progress"><div class="bar" style="width:{loadedPercent}%"></div></div>'
                    }
                }
            });

            var uploader = new Uploader.Uploader({
                //指定使用主题
                theme: 'mainImgView',
                render: '#mainImgView',
                rules: {
                    ext: ['.jpg,.jpeg,.png,.bmp','文件类型只能为{0}'],
                    max: [1, '文件的最大个数不能超过{0}个'],
                    minSize: [1, '文件的大小不能小于{0}KB'],
                    maxSize: [2048, '文件大小不能大于2M']
                }
            }).render();

        });

    </script>
    <!-- script end -->
</div>
</body>
</html>
<script type="text/javascript">
    $(function(){

        var categories = (function () {
            var cats = null;
            $.ajax({
                url : '<?= Yii::$app->urlManager->createUrl(['category/ajax-get-category-map'])?>',
                dataType : 'JSON',
                async : false,
                data : {},
                success : function (data) {
                    cats = data.data || {};
                }
            });
            return cats;
        })();

        (function(){
            var first_categories = categories[0] || {};
            var html = '';
            for(var i in first_categories) {
                html += '<option value="'+first_categories[i].id+'">'+ first_categories[i].name +'</option>';
            }
            $(".first-categories").append(html);
        })();

        //第一类别选择
        $(".first-categories").change(function(){
            var val = $(this).val();
            $(".second-categories").show();
            $(".three-categories").empty().hide();
            $("#attr-select").empty().hide();
            $("#cid").val(val);
            var second_categories = categories[val] || {};
            var html = '<option>--请选择--</option>';
            for(var j in second_categories) {
                html += '<option value="'+second_categories[j].id+'">'+ second_categories[j].name +'</option>';
            }
            $(".second-categories").empty().append(html);
        });

        //第二类别选择
        $(".second-categories").change(function(){
            var val = $(this).val();
            $(".three-categories").empty();
            $("#attr-select").empty().hide();
            $("#cid").val(val);
            var three_categories = categories[val] || {};
            var html = '<option>--请选择--</option>';
            for(var j in three_categories) {
                html += '<option value="'+three_categories[j].id+'">'+ three_categories[j].name +'</option>';
            }
            $(".three-categories").show().append(html);
        });

        //属性查找
        $(".three-categories").change(function(){
            $("#attr-select").empty().hide;
            var categoryID = $(this).val();
            $("#cid").val(categoryID);
            $.ajax({
                type : "GET",
                url : '<?= Yii::$app->urlManager->createUrl("category/get-attr-val-by-cid")?>',
                data : {cid : categoryID},
                dataType : 'json',
                success : function(data) {
                    var attr = data.data || {};
                    if (attr) {
                        var html = '<div class="control-group">';
                        for (var k in attr) {
                            html += '<label class="control-label">'+attr[k].name+'：</label>';
                            html += '<div class="controls control-row-auto" style="width: 70%">';
                            var val = attr[k].value || {};
                            for (var v in val) {
                                html += '<label class="checkbox" style="margin-right: 10px">';
                                html += '<input name="vid" type="checkbox" value="'+attr[k].id+'-'+val[v].id+'">';
                                html += val[v].name;
                                html += '</label>';
                            }
                            html += '</div></div>';
                        }
                        $("#attr-select").append(html).show();
                    }
                }
            });
        });

        //提交表单
        $("#submit-form").on("click", function(e){

            e.preventDefault();
            var cid = $("#cid").val();
            var name = $("input[name=name]").val();
            var goods_no = $("input[name=goods_no]").val();
            var sell_price = $("input[name=sell_price]").val();
            var market_price = $("input[name=market_price]").val();
            var cost_price = $("input[name=cost_price]").val();
            var categoryID = $("input[name=cid]").val();
            var is_del = $("input[name=is_del][type=radio][checked]").val();
            var content = editor.$txt.html();
            var keywords = $("input[name=keywords]").val();
            var description = $("#description").text();
            var mainImg = $("input[name=mainImg]").val();

            if (!categoryID) {
                alert("请选择分类");
                return false;
            }

            var data = {
                cid          : cid,
                name         : name,
                goods_no     : goods_no,
                sell_price   : sell_price,
                market_price : market_price,
                cost_price   : cost_price,
                categoryID   : categoryID,
                is_del       : is_del,
                content      : content,
                keywords     : keywords,
                description  : description,
                mainImg      : mainImg,
                recommend    : [],
                photo        : [],
                attr_vid     : []
            };

            //推荐商品
            $("input[name='recommend']:checked").each(function(){
                var val = $(this).val();
                data.recommend.push(val);
            });

            //相册
            $("input[name=photo]").each(function(){
                var img = $(this).val();
                data.photo.push(img);
            });

            //商品属性值
            $("input[name='vid']:checked").each(function(){
                var vid = $(this).val();
                data.attr_vid.push(vid);
            });

            $.ajax({
                dataType : "Json",
                type : "post",
                data : data,
                url : "<?= Yii::$app->urlManager->createUrl(['goods/add']) ?>",
                success : function (data) {
                    if (data.status == 1) {
                        alert("添加失败");
                    } else {
                        alert("添加成功");
                        //window.location.href = "<?= Yii::$app->urlManager->createUrl(['goods/list']) ?>";
                    }
                }
            });
        });

    })
</script>
