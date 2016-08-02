<?php
use yii\helpers\Html;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>属性列表</title>
    <?= Html::cssFile('/public/backend/css/bs3/dpl-min.css')?>
    <?= Html::cssFile('/public/backend/css/bs3/bui-min.css')?>
</head>
<body>
<div class="demo-content" style="margin: 20px 20px">
    <div class="row">
        <div class="span16">
            <div id="grid">

            </div>
        </div>
    </div>
    <!-- 初始隐藏 dialog内容 -->
    <div id="content" class="hide">
        <form class="form-horizontal">
            <div class="row">
                <input type="hidden" name="id">
                <div class="control-group span8">
                    <label class="control-label"><s>*</s>名称：</label>
                    <div class="controls">
                        <input name="name" type="text" data-rules="{required:true}" class="input-normal control-text">
                    </div>
                </div>
                <div class="control-group span8">
                    <label class="control-label"><s>*</s>排序：</label>
                    <div class="controls">
                        <input name="sort" type="text" data-rules="{required:true,number : true}" class="input-normal control-text">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="control-group span8">
                    <label class="control-label">选择：</label>
                    <div class="controls">
                        <select name="status" class="input-normal">
                            <option value="0">启用</option>
                            <option value="1">禁用</option>
                        </select>
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
        BUI.use(['bui/grid','bui/data'],function(Grid,Data){
            var Grid = Grid,
                Store = Data.Store,
                enumObj = {"0" : "启用","1" : "禁用"},
                columns = [
                    {title : '编号',dataIndex :'id'},
                    {title : '名称',dataIndex :'name'}, //editor中的定义等用于 BUI.Form.Field.Text的定义
                    {title : '排序', dataIndex :'sort'},
                    {title : '状态',dataIndex : 'status',renderer : Grid.Format.enumRenderer(enumObj)},
                    {title : '操作',renderer : function(){
                        return '<span class="grid-command btn-edit">编辑</span>'
                    }}
                ];

            var editing = new Grid.Plugins.DialogEditing({
                    contentId : 'content', //设置隐藏的Dialog内容
                    triggerCls : 'btn-edit', //触发显示Dialog的样式
                    editor: {
                        title: '编辑'
                    },
                    autoSave : true //自动添加和更新
                }),
                store = new Store({
                    autoLoad:true,
                    url : '<?= Yii::$app->urlManager->createUrl('attr/list')?>',
                    //autoSync : true, //保存数据后自动调用store.load()方法
                    proxy : {
                        method : 'POST', //更改为POST
                        save : '<?= Yii::$app->urlManager->createUrl('attr/save')?>' //会附加一个saveType 的参数，add,remove,update
                        //也可以使用一下方式：
                        //save : {
                        //  addUrl : 'data/add.php',
                        //  removeUrl : 'data/remove.php',
                        //  updateUrl : 'data/update.php'
                        //}
                    }
                }),
                grid = new Grid.Grid({
                    render:'#grid',
                    columns : columns,
                    width : 1000,
                    forceFit : true,
                    tbar:{ //添加、删除
                        items : [{
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
                            }]
                    },
                    plugins : [editing,Grid.Plugins.CheckSelection],
                    store : store
                });

            grid.render();

            //保存成功时的回调函数,其实更好的方式是直接在保存成功后调用store.load()方法，更新所有数据
            store.on('saved',function (ev) {
                var type = ev.type, //保存类型，add,remove,update
                    saveData = ev.saveData, //保存的数据
                    data = ev.data; //返回的数据

                //TO DO
                if(type == 'add'){ //新增记录时后台返回id
                    saveData.id = data.id;
                    grid.updateItem(saveData);
                    //store.update()
                    //BUI.Message.Alert('添加成功！');
                }else if(type == 'update'){
                    //BUI.Message.Alert('更新成功！');
                }else{
                    //BUI.Message.Alert('删除成功！');
                }
            });
            //保存或者读取失败
            store.on('exception',function (ev) {
                BUI.Message.Alert(ev.error);
            });

            //添加记录
            function addFunction(){
                var newData = {b : 0};
                editing.add(newData,'a'); //添加记录后，直接编辑
            }
            //删除选中的记录
            function delFunction(){
                var selections = grid.getSelection(),
                    ids = BUI.Array.map(selections,function (item) {
                        return item.id;
                    });
                store.remove(selections);
                store.save('remove',{ids : ids.join(',')}); //save的第三个参数是回调函数
            }
        });
    </script>
    <!-- script end -->
</div>
</body>
</html>