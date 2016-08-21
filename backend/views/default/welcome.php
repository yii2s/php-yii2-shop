<!DOCTYPE HTML>
<html>
<head>
    <title> 可编辑表格</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <?= Html::cssFile('public/backend/css/bs3/dpl-min.css')?>
    <?= Html::cssFile('public/backend/css/bs3/bui-min.css')?>
    <?= Html::cssFile('public/backend/css/page-min.css')?>
    <?= Html::cssFile('public/backend/css/prettify.css')?>
    <style type="text/css">
        code {
            padding: 0px 4px;
            color: #d14;
            background-color: #f7f7f9;
            border: 1px solid #e1e1e8;
        }
    </style>
</head>
<body>

<div class="container">
    <div id="grid"></div>
    <p>
        <button id="btnSave" class="button button-primary">提交</button>
    </p>
    <h2>提交结果</h2>
    <div class="row">
        <div id="log" class="well span12">

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

<script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl;?>public/backend/js/jquery-1.8.1.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl;?>public/backend/js/bui-min.js"></script>

<script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl;?>public/backend/js/config-min.js"></script>
<script type="text/javascript">
    BUI.use('common/page');
</script>
<!-- 仅仅为了显示代码使用，不要在项目中引入使用-->
<script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl;?>public/backend/js/prettify.js"></script>
<script type="text/javascript">
    $(function () {
        prettyPrint();
    });
</script>
<script type="text/javascript">
    BUI.use(['bui/grid','bui/data'],function (Grid,Data) {

        var columns = [
                {title : '学校名称',dataIndex :'school',editor : {xtype : 'text',rules:{required:true}}},
                {title : '入学日期',dataIndex :'enter',editor : {xtype : 'date',rules:{required:true}},renderer : Grid.Format.dateRenderer},//使用现有的渲染函数，日期格式化
                {title : '毕业日期',dataIndex :'outter',editor : {xtype : 'date',rules:{required:true},validator : function(value,obj){
                    if(obj.enter && value && obj.enter > value){
                        return '毕业日期不能晚于入学日期！'
                    }
                }},renderer : Grid.Format.dateRenderer},
                {title : '备注',dataIndex :'memo',width:200,editor : {xtype : 'text'}},
                {title : '操作',renderer : function(){
                    return '<span class="grid-command btn-edit">编辑</span>';
                }}

            ],
        //默认的数据
            data = [{id:'1',school:'武汉第一初级中学',enter:936144000000,outter:'2001-01-01',memo:'表现优异，多次评为三好学生'},
                {id:'2',school:'武汉第一高级中学',enter:999561600000,outter:1057017600000,memo:'表现优异，多次评为三好学生'}],
            store = new Data.Store({
                data:data
            }),

            editing = new Grid.Plugins.DialogEditing({
                contentId : 'content',
                triggerCls : 'btn-edit'
            }),

            //editing = new Grid.Plugins.CellEditing(),
            grid = new Grid.Grid({
                render : '#grid',
                columns : columns,
                width : 700,
                forceFit : true,
                store : store,
                plugins : [Grid.Plugins.CheckSelection,editing],
                tbar:{
                    items : [
                        {
                            btnCls : 'button button-small',
                            text : '<i class="icon-plus"></i>添加',
                            listeners : {
                                'click' : addFunction
                            }
                        },
                        {
                            btnCls : 'button button-small',
                            text : '<i class="icon-remove"></i>删除',
                            listeners : {
                                'click' : delFunction
                            }
                        },
                    ]
                }

            });
        grid.render();

        function addFunction(){
            var newData = {school :'请输入学校名称'};
            store.add(newData);
            editing.edit(newData,'school'); //添加记录后，直接编辑
        }

        function delFunction(){
            var selections = grid.getSelection();
            store.remove(selections);
        }
        var logEl = $('#log');
        $('#btnSave').on('click',function(){
            //if(editing.isValid()){
                var records = store.getResult();
                logEl.text(BUI.JSON.stringify(records));
            //}
        });
    });
</script>

<body>
</html>