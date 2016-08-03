<?php
use yii\helpers\Html;
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>添加属性值</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <?= Html::cssFile('/public/backend/css/bs3/dpl-min.css')?>
    <?= Html::cssFile('/public/backend/css/bs3/bui-min.css')?>
    <?= Html::cssFile('/public/backend/css/page-min.css')?>
    <?= Html::cssFile('/public/backend/css/prettify.css')?>
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
        .defaultTheme .bui-queue-item .error{
            padding-left: 10px;
            overflow: hidden;
            height: 20px;
            margin-bottom: 20px;
            background-color: #ffffff;
            border-radius: 4px;
            -webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
            border: solid 1px red;
        }
        .defaultTheme .bui-queue-item .success{
            padding-left: 10px;
            overflow: hidden;
            height: 20px;
            margin-bottom: 20px;
            background-color: #ffffff;
            border-radius: 4px;
            -webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
            border: solid 1px green;
        }
    </style>
</head>
<body>

<div class="container">
    <div id="tab">
        <ul>
            <li class="bui-tab-panel-item active"><a href="#">单个添加</a></li>
            <li class="bui-tab-panel-item"><a href="#">文件导入</a></li>
        </ul>
    </div>
    <div id="panel" class="">
        <!--标签一start-->
        <div id="p1">
            <br>
            <form id="J_Form_1" action="<?= Yii::$app->urlManager->createUrl(['attr/save'])?>" class="form-horizontal" method="post">
                <div class="" style="padding-left: 50px">
                    <div class="checkbox" style="width: 100%;line-height: 30px">
                        <input type="checkbox"> 复选框
                        <input type="checkbox"> 复选框
                        <input type="checkbox"> 复选框
                        <input type="checkbox"> 复选框
                        <input type="checkbox"> 复选框
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><s>*</s>属性名称：</label>
                    <div class="controls">
                        <input name="name" type="text" class="input-large" data-rules="{required : true}" value="<?= Html::encode($curCategory->name)?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">排序：</label>
                    <div class="controls">
                        <input name="sort" type="text" class="input-large" value="0">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">是否启用：</label>
                    <div class="controls">
                        <label class="radio" for=""><input type="radio" name="status" value="1" <?= $curCategory->visibility == 1 ? 'checked=checked' : ''; ?>>否</label>&nbsp;&nbsp;&nbsp;
                        <label class="radio" for=""><input type="radio" name="status" value="0" <?= $curCategory->visibility == 0 ? 'checked=checked' : ''; ?>>是</label>
                    </div>
                </div>
                <div class="row actions-bar">
                    <div class="form-actions span13 offset3">
                        <button type="submit" class="button button-primary">保存</button>
                        <button type="reset" class="button">重置</button>
                    </div>
                </div>
            </form>
        </div>
        <!--标签二start-->
        <div id="p2">
            <br>
            <form id="J_Form_2" action="<?= Yii::$app->urlManager->createUrl(['attr/save'])?>" class="form-horizontal" method="post">
                <div class="row">
                    <div class="span8">
                        <div id="J_Uploader">
                        </div>
                    </div>
                </div>
                <div class="row actions-bar">
                    <div class="form-actions span13 offset3">
                        <button type="submit" class="button button-primary">保存</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>

<?= Html::jsFile('public/common/js/jquery-1.8.1.min.js')?>
<?= Html::jsFile('public/backend/js/bui-min.js')?>
<?= Html::jsFile('public/backend/js/config2.js')?>

<script type="text/javascript">
    BUI.use(['bui/form','bui/tab'],function  (Form,Tab) {

        new Form.Form({
            srcNode : '#J_Form_1',
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

        new Form.Form({
            srcNode : '#J_Form_2',
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

        new Tab.TabPanel({
            srcNode : '#tab',
            elCls : 'nav-tabs',
            itemStatusCls : {
                'selected' : 'active'
            },
            panelContainer : '#panel'//如果不指定容器的父元素，会自动生成
            //selectedEvent : 'mouseenter'//默认为click,可以更改事件
        }).render();

    });

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
                    'success': '<div class="success">{name}<input type="hidden" value="{url}" name="fileUrl"></div>',
                    'error': '<div class="error"><span class="uploader-error">{msg}</span></div>'
                }
            },
            rules: {
                //文的类型
                ext: ['.xls,.xlsx,.png','文件类型只能为{0}'],
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

        $(document).on("click","bui-queue-item-del",function(){
            alert("sdfsdf");
            $(".bui-simple-list").children("ul").remove();
        })
    });

</script>