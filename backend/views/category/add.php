<?php
use yii\helpers\Html;
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>添加分类</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <?= Html::cssFile('public/backend/css/bs3/dpl-min.css')?>
    <?= Html::cssFile('public/backend/css/bs3/bui-min.css')?>
    <?= Html::cssFile('public/backend/css/page-min.css')?>
    <?= Html::cssFile('public/backend/css/prettify.css')?>
    <?= Html::cssFile('public/common/css/site.css')?>
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
    <form id="J_Form" action="<?= Yii::$app->urlManager->createUrl(['category/add'])?>" class="form-horizontal" method="post">
        <div class="control-group">
            <div class="control-label">选择分类：</div>
            <div class="category-box">
                <div class="category-list">
                    <?php if ($curCategory && $parentName) { ?>
                        <span parent-id="0">选择分类</span>
                        <span parent-id="<?= $curCategory->parent_id?>" class="select-on"><?= Html::encode($parentName); ?></span>
                    <?php } else { ?>
                        <span parent-id="0" class="select-on">选择分类</span>
                    <?php } ?>
                </div>
            </div>
        </div>
        <input type="hidden" value="<?= $curCategory->parent_id ?: 0; ?>" name="parent_id" id="parent_id">
        <div class="control-group">
            <label class="control-label"><s>*</s>分类名称：</label>
            <div class="controls">
                <input name="name" type="text" class="input-large" data-rules="{required : true}" value="<?= Html::encode($curCategory->name)?>">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">排序：</label>
            <div class="controls">
                <input name="sort" type="text" class="input-large" value="<?= Html::encode($curCategory->sort)?>">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">SEO标题：</label>
            <div class="controls">
                <input name="title" type="text" class="input-large" value="<?= Html::encode($curCategory->title)?>">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">SEO关键字：</label>
            <div class="controls">
                <input name="keywords" type="text" class="input-large" value="<?= Html::encode($curCategory->keywords)?>">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">SEO描述：</label>
            <div class="controls  control-row-auto">
                <textarea name="descript" class="control-row4 input-large"><?= Html::encode($curCategory->descript)?></textarea>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">是否在首页显示：</label>
            <div class="controls">
                <label class="radio" for=""><input type="radio" name="visibility" value="1" <?= $curCategory->visibility == 1 ? 'checked=checked' : ''; ?>>是</label>&nbsp;&nbsp;&nbsp;
                <label class="radio" for=""><input type="radio" name="visibility" value="0" <?= $curCategory->visibility == 0 ? 'checked=checked' : ''; ?>>否</label>
            </div>
        </div>
        <input type="hidden" value="<?= $curCategory->id;?>" name="id">
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
                    $.get("<?= Yii::$app->urlManager->createUrl(['category/cache'])?>");
                    setTimeout(function(){
                        window.location.href = "<?= Yii::$app->urlManager->createUrl(['category/list'])?>";
                    })
                }
            }
        }).render();

        function show (msg) {
            BUI.Message.Show({
                msg : msg,
                icon : 'question',
                buttons : [],
                autoHide : true,
                autoHideDelay : 2000
            });
        }

        //show();

        //所有分类
        var categories = <?= json_encode($categories);?>;

        //类别选择
        $(document).on("click",".category-list span",function(){
            var $self = $(this);
            $self.addClass("select-on").siblings().removeClass("select-on");
            $self.parent().parent().nextAll().remove();

            var parentID = $(this).attr("parent-id");
            $("#parent_id").val(parentID);

            var list = categories[parentID] || {};
            if (list.length > 0) {
                var html = '<div class="control-label">选择分类：</div>';
                html += '<div class="category-box">';
                html += '<div class="category-list">';

                for(var i in list) {
                    html += '<span parent-id="'+ list[i].id +'">';
                    html += list[i].name;
                    html += '</span>';
                }
                $self.parent().parent().after(html);
            }
        });

    });
</script>