<?php
use yii\helpers\Html;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>列表</title>
    <?= Html::cssFile('/public/backend/css/dpl-min.css')?>
    <?= Html::cssFile('/public/backend/css/bui-min.css')?>
</head>
<body>
<div class="">
    <div class="row">
        <div style="width: 98%; margin-left: 10px">
            <div class="panel panel-head-borded panel-small">
                <div id="t1">

                </div>
            </div>

        </div>
    </div>

    <div id="content" class="hide">
        <form id="J_Form" class="form-horizontal">
            <div class="row">
                <div class="control-group span8">
                    <label class="control-label"><s>*</s>学校名称：</label>
                    <div class="controls">
                        <input name="school" type="text" data-rules="{required:true}" class="input-normal control-text">
                    </div>
                </div>
                <div class="control-group span8">
                    <label class="control-label"><s>*</s>学生类型：</label>
                    <div class="controls">
                        <select  data-rules="{required:true}"  name="type" class="input-normal">
                            <option value="">请选择</option>
                            <option value="zou">走读</option>
                            <option value="zhu">住校</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="control-group span15 ">
                    <label class="control-label">在校日期：</label>
                    <div id="range" class="controls bui-form-group" data-rules="{dateRange : true}">
                        <input name="enter" class="calendar" type="text"><label>&nbsp;-&nbsp;</label><input name="outter" class="calendar" type="text">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="control-group span15">
                    <label class="control-label">备注：</label>
                    <div class="controls control-row4">
                        <textarea name="memo" class="input-large" type="text"></textarea>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <?= Html::jsFile('public/common/js/jquery-1.8.1.min.js')?>
    <?= Html::jsFile('public/backend/js/bui-min.js')?>
    <?= Html::jsFile('public/backend/js/config-min.js')?>

    <!-- script start -->
    <script type="text/javascript">
        BUI.use(['bui/extensions/treegrid'],function (TreeGrid) {

            var data = <?= $categories?>;
            //由于这个树，不显示根节点，所以可以不指定根节点
            var tree = new TreeGrid({
                render : '#t1',
                nodes : data,
                columns : [
                    {title : '分类',dataIndex :'text',width:400},
                    {title : '名称',dataIndex :'name',width:300},
                    {title : '排序',dataIndex : 'sort',width:300},
                    {title : '操作',renderer : function(){
                        return '<span class="grid-command btn-edit">编辑</span>'
                    }}
                ],
                height:500
            });
            tree.render();
        });
    </script>

    <!-- script end -->
</div>
</body>
</html>