<?php
use yii\helpers\Html;
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>添加属性值</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <?= Html::cssFile('public/backend/css/bs3/dpl-min.css')?>
    <?= Html::cssFile('public/backend/css/bs3/bui-min.css')?>
    <?= Html::cssFile('public/backend/css/page-min.css')?>
    <?= Html::cssFile('public/backend/css/prettify.css')?>
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
    <br>
    <form id="J_Form" action="<?= Yii::$app->urlManager->createUrl(['attr/add-attr-val'])?>" class="form-horizontal" method="post">
        <div class="" style="padding-left: 50px;margin-bottom: 20px;">
            <div class="checkbox" style="width: 100%;line-height: 30px">
                <?php foreach((array)$attrs as $a) { ?>
                <input name="attr[]" type="checkbox" value="<?= $a->id; ?>"> <?= Html::encode($a->name)?>
                <?php } ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">属性值：</label>
            <div class="controls  control-row-auto">
                <textarea name="value" class="control-row4" style="width: 500px" data-tip="{text:'多个属性值用英文逗号隔开'}" data-rules="{required : true}"></textarea>
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

    });

</script>