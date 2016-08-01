<?php
use yii\helpers\Html;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>添加商品</title>
    <?= Html::cssFile('/public/backend/css/bs3/dpl-min.css')?>
    <?= Html::cssFile('/public/backend/css/bs3/bui-min.css')?>
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
        <div class="span24">
            <form id="J_Form" class="form-horizontal" method="post" action="#">
                <div id="tab">
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
                            <label class="control-label"><s>*</s>店铺名称：</label>
                            <div class="controls">
                                <input name="sname" type="text" class="input-large" data-rules="{required : true}">
                            </div>
                        </div>
                        <div class="control-group">
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
                            <label class="control-label">上架时间：</label>
                            <div class="controls control-row-auto">
                                <label class="radio">
                                    <input type="radio" name="uptime" value="now" checked="checked">立刻
                                </label>
                                <label  class="radio">
                                    <input id="chk" type="radio" name="uptime" value="set">设定
                                </label>
                                <label class="radio">
                                    <input type="radio" name="uptime" value="inputc">放入仓库
                                </label>

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
                        </div>
                        <div class="control-group">
                            <label class="control-label">4PL处理订单类型：</label>
                            <div class="controls">
                                <label class="checkbox">
                                    <input type="checkbox" value="零售">零售
                                </label>
                                <label class="checkbox">
                                    <input type="checkbox" value="聚划算" checked="checked">聚划算
                                </label>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">仓原备注：</label>
                            <div class="controls control-row4">
                                <textarea type="text" class="input-large" data-valid="{}"></textarea>
                            </div>
                        </div>
                    </div>
                    <!--标签二start-->
                    <div id="p2">
                        <h3></h3>
                        <div class="control-group">
                            <label class="control-label"><s>*</s>关键字名称：</label>
                            <div class="controls">
                                <input name="sname" type="text" class="input-large" data-rules="{required : true}">
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
                <hr>
                <div class="form-actions span5 offset3">
                    <button id="btnSearch" type="submit" class="button button-primary">提交</button>
                </div>
            </form>
        </div>
    </div>
    <?= Html::jsFile('public/common/js/jquery-1.8.1.min.js')?>
    <?= Html::jsFile('public/backend/js/bui-min.js')?>
    <?= Html::jsFile('public/backend/js/config2.js')?>

    <script type="text/javascript">
        BUI.use(['bui/form','bui/tab'],function  (Form,Tab) {

            new Form.Form({
                srcNode : '#J_Form'
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

            //添加自定义主题
            Uploader.Theme.addTheme('imageView', {
                elCls: 'imageViewTheme',
                //可以设定该主题统一的上传路径
                url: '../../../test/upload/upload.php',
                queue:{
                    //结果的模板，可以根据不同状态进进行设置
                    resultTpl: {
                        'default': '<div class="default">{name}</div>',
                        'success': '<div class="success"><img src="../../../test/upload/{url}" /></div>',
                        'error': '<div class="error"><span class="uploader-error">{msg}</span></div>',
                        'progress': '<div class="progress"><div class="bar" style="width:{loadedPercent}%"></div></div>'
                    }
                }
            });

            var uploader = new Uploader.Uploader({
                //指定使用主题
                theme: 'imageView',
                render: '#J_Uploader',
                //不设时使用主题配置的上传路径
                url: '../../../test/upload/upload.php'
            }).render();
        });

    </script>
    <!-- script end -->
</div>
</body>
</html>