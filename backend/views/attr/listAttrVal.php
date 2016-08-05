<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>搜索页</title>
    <link href="http://g.alicdn.com/bui/bui/1.1.21/css/bs3/dpl.css" rel="stylesheet">
    <link href="http://g.alicdn.com/bui/bui/1.1.21/css/bs3/bui.css" rel="stylesheet">

</head>
<body>
<div class="demo-content" style="margin: 20px 10px">
    <!-- 初始隐藏 dialog内容 -->
    <div id="content" class="hide">
        <form class="form-horizontal">
            <div class="row">
                <input type="hidden" name="id">
                <div class="control-group span8">
                    <label class="control-label"><s>*</s>属性值：</label>
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

    <!-- 搜索页 ================================================== -->
    <div class="row">
            <form id="searchForm" class="form-horizontal" tabindex="0" style="outline: none;">
                <div class="control-group">
                    <label class="control-label"><s>*</s>属性名称：</label>
                    <div class="controls" style="margin-right: 20px">
                        <select data-rules="{required:true}" name="attrID" id="select-attr">
                            <option value="">-请选择-</option>
                            <?php foreach((array)$attrs as $a) { ?>
                            <option value="<?= $a->id; ?>"><?= $a->name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div>
                        <button id="btnSearch" type="submit" class="button button-primary">搜索</button>
                    </div>
                </div>
            </form>
    </div>
    <div id="c1"</div>
    <div class="search-grid-container">
        <div id="grid">
        </div>
        <script src="http://g.tbcdn.cn/fi/bui/jquery-1.8.1.min.js"></script>
        <script src="http://g.tbcdn.cn/fi/bui/bui-min.js?t=201309041336"></script>
        <script type="text/javascript">
            BUI.use(['bui/grid','bui/data'],function(Grid,Data) {
                var Grid = Grid,
                    Store = Data.Store,
                    columns = [
                        {title: 'ID', dataIndex: 'id', width: 100},
                        {title: '属性值', dataIndex: 'name', width: 100},
                        {title: '排序', dataIndex: 'sort', width: 200},
                        {title: '状态', dataIndex: 'status', width: 200},
                        {
                            title: '操作', renderer: function () {
                            return '<span class="grid-command btn-edit">编辑</span>'
                        }
                        }
                    ];

                var editing = new Grid.Plugins.DialogEditing({
                        contentId: 'content', //设置隐藏的Dialog内容
                        triggerCls: 'btn-edit', //触发显示Dialog的样式
                        editor: {
                            title: '编辑'
                        },
                        autoSave: true //自动添加和更新
                    }),

                    store = new Store({
                        autoLoad: true,
                        url: '<?= Yii::$app->urlManager->createUrl('attr/list-attr-val')?>',
                        //autoSync : true, //保存数据后自动调用store.load()方法
                        proxy: {
                            method: 'POST', //更改为POST
                            save : '<?= Yii::$app->urlManager->createUrl('attr/add-one-attr-val')?>'
                        },
                        /*params: { //配置初始请求的参数
                            attrID: $("#select-attr").val()
                        },*/
                        pageSize: 10
                    }),

                    grid = new Grid.Grid({
                        render: '#grid',
                        loadMask: true,
                        forceFit: true,
                        width: 900,
                        columns: columns,
                        store: store,
                        plugins: [Grid.Plugins.CheckSelection, Grid.Plugins.AutoFit, editing], //勾选插件、自适应宽度插件
                        // 顶部工具栏
                        tbar: { //添加、删除
                            items: [{
                                btnCls: 'button button-small',
                                text: '<i class="icon-plus"></i>添加',
                                listeners: {
                                    'click': addFunction
                                }
                            },
                                {
                                    btnCls: 'button button-small',
                                    text: '<i class="icon-remove"></i>删除',
                                    listeners: {
                                        'click': delFunction
                                    }
                                }]
                        },
                        bbar: {
                            // pagingBar:表明包含分页栏
                            pagingBar: true
                        }
                    });
                grid.render();

                //保存成功时的回调函数,其实更好的方式是直接在保存成功后调用store.load()方法，更新所有数据
                store.on('saved', function (ev) {
                    var type = ev.type, //保存类型，add,remove,update
                        saveData = ev.saveData, //保存的数据
                        data = ev.data; //返回的数据

                    //TO DO
                    if (type == 'add') { //新增记录时后台返回id
                        saveData.id = data.id;
                        grid.updateItem(saveData);
                        store.update()
                        BUI.Message.Alert('添加成功！');
                    } else if (type == 'update') {
                        BUI.Message.Alert('更新成功！');
                    } else {
                        BUI.Message.Alert('删除成功！');
                    }
                });


                //创建表单，表单中的日历，不需要单独初始化
                var form = new BUI.Form.HForm({
                    srcNode: '#searchForm'
                }).render();

                form.on('beforesubmit', function (ev) {
                    //序列化成对象
                    var obj = form.serializeToObject();
                    obj.start = 0; //返回第一页
                    store.load(obj);
                    return false;
                });

                //添加记录
                function addFunction() {
                    var attrID = $("#select-attr").val();
                    if (!attrID) {
                        BUI.Message.Alert('请选择属性名称！');
                        return ;
                    }
                    var newData = {attrID: attrID};
                    editing.add(newData, 'a'); //添加记录后，直接编辑
                }

                //删除选中的记录
                function delFunction() {
                    var selections = grid.getSelection(),
                        ids = BUI.Array.map(selections, function (item) {
                            return item.id;
                        });
                    store.remove(selections);
                    store.save('remove', {ids: ids.join(',')}); //save的第三个参数是回调函数
                }
            });
        </script>
        <!-- script end -->
    </div>
    </div>
</body>
</html>       