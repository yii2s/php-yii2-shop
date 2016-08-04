<?php
use yii\helpers\Html;
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>添加品牌</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <?= Html::cssFile('public/backend/css/bs3/dpl-min.css')?>
    <?= Html::cssFile('public/backend/css/bs3/bui-min.css')?>
    <?= Html::cssFile('public/backend/css/page-min.css')?>
    <?= Html::cssFile('public/backend/css/prettify.css')?>
</head>
<body>

<div class="container">
    <br>
    <form id="J_Form" action="<?= Yii::$app->urlManager->createUrl(['attr/add-brand'])?>" class="form-horizontal" method="post">
        <div class="control-group">
            <label class="control-label"><s>*</s>品牌名称：</label>
            <div class="controls">
                <input name="name" type="text" class="input-large" data-rules="{required : true}" value="">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label"><s>*</s>品牌官网：</label>
            <div class="controls">
                <input name="url" type="text" class="input-large" data-rules="{required : true}" value="">
            </div>
        </div>
        <div class="control-group" style="margin-bottom: 20px">
            <label class="control-label"><s>*</s>品牌logo：</label>
            <div class="controls">
                <div id="J_Uploader">
                </div>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label"><s>*</s>排序：</label>
            <div class="controls">
                <input name="sort" type="text" class="input-large" data-rules="{required : true}" value="0">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">描述：</label>
            <div class="controls  control-row-auto">
                <textarea name="description" class="control-row4" style="width: 500px" data-tip="{text:'多个属性值用英文逗号隔开'}" data-rules="{required : true}"></textarea>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">是否启用：</label>
            <div class="controls">
                <label class="radio" for=""><input type="radio" name="status" value="1" <?= $curCategory->visibility == 1 ? 'checked=checked' : ''; ?>>否</label>&nbsp;&nbsp;&nbsp;
                <label class="radio" for=""><input type="radio" name="status" value="0" <?= $curCategory->visibility == 0 ? 'checked=checked' : ''; ?>>是</label>
            </div>
        </div>
        <div class="row">
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
<?= Html::jsFile('public/backend/js/config2.js')?>

<script type="text/javascript">
    BUI.use(['bui/form'],function  (Form) {

        new Form.Form({
            srcNode : '#J_Form',
            submitType : 'ajax',
            callback : function(data){
                if (data.status == 1) {
                    alert(data.msg);
                    return ;
                } else {
                    setTimeout(function(){
                        window.location.href = "<?= Yii::$app->urlManager->createUrl(['attr/list'])?>";
                    })
                }
            }
        }).render();

        BUI.use('bui/uploader',function (Uploader) {

            /**
             * 返回数据的格式
             *
             *  默认是 {url : 'url'},否则认为上传失败
             *  可以通过isSuccess 更改判定成功失败的结构
             */
            new Uploader.Uploader({
                render: '#J_Uploader',
                url: '<?= Yii::$app->urlManager->createUrl('attr/upload')?>',
                queue: {
                    resultTpl:{
                        'success': '<div class="success">{name}<input type="hidden" value="{url}" name="logo"></div>',
                        'error': '<div class="error"><span class="uploader-error">{msg}</span></div>'
                    }
                },
                rules: {
                    //文的类型
                    ext: ['.jpg,.jpeg,.png','文件类型只能为{0}'],
                    //上传的最大个数
                    max: [1, '文件的最大个数不能超过{0}个'],
                    //文件大小的最小值,这个单位是kb
                    minSize: [1, '文件的大小不能小于{0}KB'],
                    //文件大小的最大值,单位也是kb
                    maxSize: [2048, '文件大小不能大于2M']
                },
                isSuccess: function(result){
                    if(result && result.url){
                        $("#fileUrl").val(result.url);
                        return true;
                    }
                    return false;
                }
            }).render();

        });

    });

</script>