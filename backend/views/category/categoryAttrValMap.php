<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>表单分组</title>
    <link href="http://g.alicdn.com/bui/bui/1.1.21/css/bs3/dpl.css" rel="stylesheet">
    <link href="http://g.alicdn.com/bui/bui/1.1.21/css/bs3/bui.css" rel="stylesheet">

</head>
<body>
<div class="demo-content" style="margin: 20px 10px">

    <form id="J_Form"  class="form-horizontal" action="<?= Yii::$app->urlManager->createUrl('category/category-attr-val-map')?>" method="post">
        <p><h2>关联属性值</h2><span class="auxiliary-text">Note:只有第三级分类才可以关联属性值</span></p>
        <div class="control-group">
            <label class="control-label">选择分类：</label>
            <div class="controls bui-form-group-select" data-type="type1">
                <select class="input-small first-categories">
                    <option>--请选择--</option>
                </select>&nbsp;&nbsp;
                <select class="input-small hide second-categories">
                    <option>--请选择--</option>
                </select>
                <select class="input-small hide three-categories" name="cid">
                    <option>--请选择--</option>
                </select>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">选择属性：</label>
            <div class="controls bui-form-group-select" data-type="type1">
                <select class="input-small hide attr-list" name="aid">
                    <option>--请选择--</option>
                </select>
            </div>
        </div>
        <!--属性 start-->
        <div class="row">
            <div class="control-group span15">
                <label class="control-label">选择属性值：</label>
                <div class="controls attr-val-list" style="display: none">
                    <label class="checkbox"><input name="range" type="checkbox" value="1">范围1</label>
                    <label class="checkbox"><input name="range" type="checkbox" value="2">范围2</label>
                    <label class="checkbox"><input name="range" type="checkbox" value="3">范围3</label>
                </div>
            </div>
        </div>
        <!--属性 end-->
        <div class="row">
            <div class="form-actions offset3">
                <button type="submit" class="button button-primary">保存</button>
                <button type="reset" class="button">重置</button>
            </div>
        </div>

    </form>

    <script src="http://g.tbcdn.cn/fi/bui/jquery-1.8.1.min.js"></script>

</div>
</body>
</html>
<script type="text/javascript">
    $(function(){
        var categories = <?= $categories ?>;

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
            $(".attr-list").empty().hide();
            $(".attr-val-list").empty().hide();
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
            $(".attr-list").empty().hide();
            $(".attr-val-list").empty().hide();
            var three_categories = categories[val] || {};
            var html = '<option>--请选择--</option>';
            for(var j in three_categories) {
                html += '<option value="'+three_categories[j].id+'">'+ three_categories[j].name +'</option>';
            }
            $(".three-categories").show().append(html);
        });

        //属性查找
        $(".three-categories").change(function(){
            $(".attr-val-list").empty().hide();
            $(".attr-list").empty();
            var categoryID = $(this).val();
            $.ajax({
                type : "GET",
                url : '<?= Yii::$app->urlManager->createUrl("category/ajax-get-attrs")?>',
                data : {categoryID : categoryID},
                dataType : 'json',
                success : function(data) {
                    var attr_list = data || {};
                    if (attr_list) {
                        var html = '<option>--请选择--</option>';
                        for (var k in attr_list) {
                            html += '<option value="'+attr_list[k].id+'">'+ attr_list[k].name +'</option>';
                        }
                        $(".attr-list").show().append(html);
                    }
                }
            });
        });

        //选择属性值
        $(".attr-list").change(function(){
            $(".attr-val-list").empty();
            var attrID = $(this).val();
            $.ajax({
                type : 'POST',
                url : '<?= Yii::$app->urlManager->createUrl('attr/list-attr-val')?>',
                data : {attrID : attrID},
                dataType : 'JSON',
                success : function (data) {
                    var attr_val_list = data['rows'] || {};
                    if (attr_val_list) {
                        var html = '';
                        for (var a in attr_val_list) {
                            html += '<label class="checkbox"><input name="vid[]" type="checkbox" value="'+attr_val_list[a].id+'">'+attr_val_list[a].name+'</label>';
                        }
                        $(".attr-val-list").show().append(html);
                    }
                }
            });
        });

    })
</script>