<!DOCTYPE HTML>
<html>
<head>
    <title>网站信息</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style type="text/css">
        .box{
            width: 32%;
            height: auto;
            margin: 10px 5px;
            border: solid 1px #1B3160;
            float: left;
        }
        .nav{
            width: auto;
            height: 30px;
            background-color: #1B3160;
            color: #ffffff;
            font-size: 14px;
            line-height: 30px;
            padding-left: 10px;
        }
        .content{
            width: auto;
            height: auto;
            font-size: 12px;
        }
        table{
            width: 100%;
        }
        tr{
            height: 25px;
        }
        .td-left{
            text-align: left;
            width: 50%;
            height: auto;
            padding-left: 10px;
        }
        .td-right{
            text-align: right;
            width: 50%;
            height: auto;
            padding-right: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="box">
        <div class="nav">系统信息</div>
        <div class="content">
            <table>
                <tr><td class="td-left">操作系统</td><td class="td-right"><?= PHP_OS?></td></tr>
                <tr><td class="td-left">PHP版本</td><td class="td-right"><?= PHP_VERSION?></td></tr>
                <tr><td class="td-left">MYSQL版本</td><td class="td-right"><?= @mysql_get_server_info()?></td></tr>
                <tr><td class="td-left">当前时间</td><td class="td-right"><?= date('Y-m-d')?></td></tr>
                <tr><td class="td-left">上传文件大小</td><td class="td-right"><?= ini_get('post_max_size')?></td></tr>
                <tr><td class="td-left">官网地址</td><td class="td-right"><a href="javascript:void(0);">http://iwebshop.cm</a></td></tr>
            </table>
        </div>
    </div>
    <div class="box">
        <div class="nav">系统信息</div>
        <div class="content">
            <table>
                <tr><td class="td-left">购买及服务</td><td class="td-right"><a href="javascript:void(0);">联系我们</a></td></tr>
                <tr><td class="td-left">购买及服务</td><td class="td-right">联系我们</td></tr>
                <tr><td class="td-left">购买及服务</td><td class="td-right">联系我们</td></tr>
                <tr><td class="td-left">购买及服务</td><td class="td-right">联系我们</td></tr>
                <tr><td class="td-left">购买及服务</td><td class="td-right">联系我们</td></tr>
                <tr><td class="td-left">购买及服务</td><td class="td-right">联系我们</td></tr>
            </table>
        </div>
    </div>
    <div class="box">
        <div class="nav">系统信息</div>
        <div class="content">
            <table>
                <tr><td class="td-left">购买及服务</td><td class="td-right">联系我们</td></tr>
                <tr><td class="td-left">购买及服务</td><td class="td-right">联系我们</td></tr>
                <tr><td class="td-left">购买及服务</td><td class="td-right">联系我们</td></tr>
                <tr><td class="td-left">购买及服务</td><td class="td-right">联系我们</td></tr>
                <tr><td class="td-left">购买及服务</td><td class="td-right">联系我们</td></tr>
                <tr><td class="td-left">购买及服务</td><td class="td-right">联系我们</td></tr>
            </table>
        </div>
    </div>
    <div class="box">
        <div class="nav">系统信息</div>
        <div class="content">
            <table>
                <tr><td class="td-left">购买及服务</td><td class="td-right">联系我们</td></tr>
                <tr><td class="td-left">购买及服务</td><td class="td-right">联系我们</td></tr>
                <tr><td class="td-left">购买及服务</td><td class="td-right">联系我们</td></tr>
                <tr><td class="td-left">购买及服务</td><td class="td-right">联系我们</td></tr>
                <tr><td class="td-left">购买及服务</td><td class="td-right">联系我们</td></tr>
                <tr><td class="td-left">购买及服务</td><td class="td-right">联系我们</td></tr>
            </table>
        </div>
    </div>
</div>


</body>
</html>