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

    <form id="J_Form"  class="form-horizontal" action="<?= Yii::$app->urlManager->createUrl('category/category-attr-map')?>" method="post">
        <p><h2>分类关联属性</h2><span class="auxiliary-text"><!--Note:只有第三级分类才可以关联属性--></span></p>
        <div class="control-group">
            <label class="control-label">选择分类：</label>
            <div class="controls bui-form-group-select" data-type="type1">
                <select class="input-small first-categories">
                    <option>--请选择--</option>
                </select>&nbsp;&nbsp;
                <select class="input-small hide second-categories">
                    <option>--请选择--</option>
                </select>
                <select class="input-small hide three-categories">
                    <option>--请选择--</option>
                </select>
                <input id="cid" name="cid" value="" type="hidden">
            </div>
        </div>
        <!--属性 start-->
        <div class="row">
            <div class="control-group">
                <label class="control-label">选择属性：</label>
                <div class="controls" style="margin: 0px 30px;width: 70%; height: auto">
                    <?php foreach ($attrs as $a) { ?>
                    <label class="checkbox" style="margin-right:20px"><input name="aids[]" type="checkbox" value="<?= $a->id?>"><?= $a->name?></label>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!--属性 end-->
        <br style="clear:both;" />
        <div class="row">
            <div class="form-actions offset3">
                <button type="submit" class="button button-primary" id="submit-form">保存</button>
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
            $("#cid").val(val);
            $(".second-categories").show();
            $(".three-categories").empty().hide();
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
            $("#cid").val(val);
            $(".three-categories").empty();
            var three_categories = categories[val] || {};
            var html = '<option>--请选择--</option>';
            for(var j in three_categories) {
                html += '<option value="'+three_categories[j].id+'">'+ three_categories[j].name +'</option>';
            }
            $(".three-categories").show().append(html);
        });

        //第三类别选择
        $(".three-categories").change(function(){
            var val = $(this).val();
            $("#cid").val(val);
        });

        //提交表单
        $("#submit-form").on("click", function(e) {
            e.preventDefault();
            $.ajax({
                url : $("#J_Form").attr("action"),
                data : $("#J_Form").serialize(),
                type : "POST",
                dataType : "Json",
                success : function (data) {
                    if (data.status == 0) {
                        alert("操作成功");
                    } else {
                        alert("操作失败");
                    }
                },
                error : function () {
                    alert("操作失败");
                }
            });
        })

    })
</script>