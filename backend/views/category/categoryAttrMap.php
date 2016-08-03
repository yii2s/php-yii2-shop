<?php
use yii\helpers\Html;
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>添加分类</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <?= Html::cssFile('/public/backend/css/bs3/dpl-min.css')?>
    <?= Html::cssFile('/public/backend/css/bs3/bui-min.css')?>
    <?= Html::cssFile('/public/backend/css/page-min.css')?>
    <?= Html::cssFile('/public/backend/css/prettify.css')?>
    <?= Html::cssFile('/public/common/css/site.css')?>
    <style type="text/css">
        code {
            padding: 0px 4px;
            color: #d14;
            background-color: #f7f7f9;
            border: 1px solid #e1e1e8;
        }
        .category-box{
            width: 100%;
            height: 40px;
        }
        .category-list{
            float: left;
            width: 70%;
            height: auto;
            margin-left: 10px;
        }
        .category-list span{
            margin-right: 10px;
            font-size: 13px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="container">
    <form id="J_Form" action="<?= Yii::$app->urlManager->createUrl(['category/category-attr-map'])?>" class="form-horizontal" method="post">
        <div class="control-group">
            <div class="control-label">选择分类：</div>
            <div class="category-box">
                <div class="category-list">
                    <?php if ($curCategory) { ?>
                        <span category-id="0">选择分类</span>
                        <span category-id="<?= $curCategory->id?>" class="select-on"><?= Html::encode($curCategory->name); ?></span>
                    <?php } else { ?>
                        <span category-id="0" class="select-on">选择分类</span>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label"><s>*</s>属性列表：</label>
            <div class="bui-form-field-checklist" data-items=<?= $attrs; ?>>
                <input name="attrIDs" type="hidden" value="<?= $attrIDs ?: 1; ?>">
            </div>
        </div>
        <input id="category-id" type="hidden" name="categoryID" value="<?= $curCategory->id?:0; ?>">
        <div class="row actions-bar">
            <div class="form-actions span13 offset3">
                <button type="submit" class="button button-primary">保存</button>
                <button type="reset" class="button">重置</button>
            </div>
        </div>
    </form>


</div>
</body>
</html>

<?= Html::jsFile('public/common/js/jquery-1.8.1.min.js')?>
<?= Html::jsFile('public/backend/js/bui-min.js')?>
<?= Html::jsFile('public/backend/js/config-min.js')?>

<script type="text/javascript">
    BUI.use('bui/form',function(Form){

        new Form.HForm({
            srcNode : '#J_Form',
            submitType : 'ajax',
            callback : function(data){
                if (data.status == 1) {
                    alert(data.msg);
                    return ;
                } else {
                    setTimeout(function(){
                        window.location.href = "<?= Yii::$app->urlManager->createUrl(['category/list'])?>";
                    })
                }
            }
        }).render();

        //所有分类
        var categories = <?= json_encode($categories);?>;

        //类别选择
        $(document).on("click",".category-list span",function(){
            var $self = $(this);
            $self.addClass("select-on").siblings().removeClass("select-on");
            $self.parent().parent().nextAll().remove();

            var categoryID = $(this).attr("category-id");
            $("#category-id").val(categoryID);

            var list = categories[categoryID] || {};
            if (list.length > 0) {
                var html = '<div class="control-label">选择分类：</div>';
                html += '<div class="category-box">';
                html += '<div class="category-list">';

                for(var i in list) {
                    html += '<span category-id="'+ list[i].id +'">';
                    html += list[i].name;
                    html += '</span>';
                }
                $self.parent().parent().after(html);
            }
        });

    });
</script>