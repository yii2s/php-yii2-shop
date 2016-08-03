<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>异步加载数据,分页</title>
    <!-- 此文件为了显示Demo样式，项目中不需要引入 -->
    <link href="../../assets/code/demo.css" rel="stylesheet">

    <link href="http://g.alicdn.com/bui/bui/1.1.21/css/bs3/dpl.css" rel="stylesheet">
    <link href="http://g.alicdn.com/bui/bui/1.1.21/css/bs3/bui.css" rel="stylesheet">

</head>
<body>
<div class="" style="margin-left: 20px">
    <br>
    <div class="row">
        <div class="span16">
            <div id="grid">

            </div>
        </div>
    </div>


    <script src="http://g.tbcdn.cn/fi/bui/jquery-1.8.1.min.js"></script>
    <script src="http://g.alicdn.com/bui/seajs/2.3.0/sea.js"></script>
    <script src="http://g.alicdn.com/bui/bui/1.1.21/config.js"></script>

    <!-- script start -->
    <script type="text/javascript">
        BUI.use(['bui/grid','bui/data'],function(Grid,Data){
            var Grid = Grid,
                Store = Data.Store,
                columns = [
                    {title : 'ID',dataIndex :'id', width:100},
                    {id: '123',title : '属性值',dataIndex :'value', width:100},
                    {title : '排序',dataIndex : 'sort',width:200},
                    {title : '状态',dataIndex : 'status',width:200},
                    {title : '操作',renderer : function(){
                        return '<span class="grid-command btn-edit">编辑</span>'
                    }}
                ];

            /**
             * 自动发送的数据格式：
             *  1. start: 开始记录的起始数，如第 20 条,从0开始
             *  2. limit : 单页多少条记录
             *  3. pageIndex : 第几页，同start参数重复，可以选择其中一个使用
             *
             * 返回的数据格式：
             *  {
         *     "rows" : [{},{}], //数据集合
         *     "results" : 100, //记录总数
         *     "hasError" : false, //是否存在错误
         *     "error" : "" // 仅在 hasError : true 时使用
         *   }
             *
             */
            var store = new Store({
                    url : '<?= Yii::$app->urlManager->createUrl('attr/list-attr-val')?>',
                    autoLoad:true, //自动加载数据
                    params : { //配置初始请求的参数
                        aid : '2'
                    },
                    pageSize:1	// 配置分页数目
                }),
                grid = new Grid.Grid({
                    render:'#grid',
                    width : 800,
                    columns : columns,
                    loadMask: true, //加载数据时显示屏蔽层
                    store: store,
                    // 底部工具栏
                    bbar:{
                        // pagingBar:表明包含分页栏
                        pagingBar:true
                    }
                });

            grid.render();
        });
    </script>
    <!-- script end -->
</div>
</body>
</html>