<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>品牌列表</title>
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
                    <label class="control-label"><s>*</s>品牌名称：</label>
                    <div class="controls">
                        <input name="name" type="text" data-rules="{required:true}" class="input-normal control-text">
                    </div>
                </div>
                <div class="control-group span8">
                    <label class="control-label"><s>*</s>排序：</label>
                    <div class="controls">
                        <input name="sort" type="text" class="input-normal control-text" data-rules="{required : true}" value="0">
                    </div>
                </div>
                <div class="control-group span8">
                    <label class="control-label"><s>*</s>品牌Logo：</label>
                    <div class="controls">
                        <div id="J_Uploader">
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><s>*</s>品牌官网：</label>
                    <div class="controls">
                        <input name="url" type="text" data-rules="{required:true}" class="input-large">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">描述：</label>
                    <div class="controls  control-row-auto">
                        <textarea name="description" class="control-row4" style="width: 500px" data-tip="{text:'多个属性值用英文逗号隔开'}" data-rules="{required : true}"></textarea>
                    </div>
                </div>
            </div>
        </form>
    </div>

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
                    {title: 'ID', dataIndex: 'id', width: 50},
                    {title: '品牌名称', dataIndex: 'name', width: 100},
                    {title: '品牌官网', dataIndex: 'url', width: 300},
                    {title: '品牌Logo', dataIndex: 'logo', width: 150,cellTpl:'<img src="{text}" width="120" height="50">'},
                    {title: '品牌描述', dataIndex: 'description', width: 400},
                    {title: '排序', dataIndex: 'sort', width: 200},
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
                    url: '<?= Yii::$app->urlManager->createUrl('attr/list-brand')?>',
                    //autoSync : true, //保存数据后自动调用store.load()方法
                    proxy: {
                        method: 'POST', //更改为POST
                        save : '<?= Yii::$app->urlManager->createUrl('attr/edit-brand')?>'
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
                    width: '1200',
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
                var newData = {b: 0};
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
                            'default': '<div class="default">{name}</div>',
                            'success': '<div class="success"><img src="{url}" width="120px" height="50px"/><input type="hidden" value="{url}" name="logo"></div>',
                            'error': '<div class="error"><span class="uploader-error">{msg}</span></div>',
                            'progress': '<div class="progress"><div class="bar" style="width:{loadedPercent}%"></div></div>'
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
    <!-- script end -->
</div>
</div>
</body>
</html>       