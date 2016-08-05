<?php
use yii\helpers\Html;
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>商城管理系统</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <?= Html::cssFile('public/backend/css/dpl-min.css')?>
    <?= Html::cssFile('public/backend/css/bui-min.css')?>
    <?= Html::cssFile('public/backend/css/main-min.css')?>
</head>
<body>

<div class="header">

    <div class="dl-title">
        <a href="http://www.builive.com" title="文档库地址" target="_blank"><!-- 仅仅为了提供文档的快速入口，项目中请删除链接 -->
            <span class="lp-title-port">商城</span><span class="dl-title-text">管理系统</span>
        </a>
    </div>

    <div class="dl-log">欢迎您，<span class="dl-log-user">吴桢灿</span><a href="###" title="退出系统" class="dl-log-quit">[退出]</a><a href="http://http://www.builive.com/" title="文档库" class="dl-log-quit">文档库</a>
    </div>
</div>
<div class="content">
    <div class="dl-main-nav">
        <div class="dl-inform"><div class="dl-inform-title">贴心小秘书<s class="dl-inform-icon dl-up"></s></div></div>
        <ul id="J_Nav"  class="nav-list ks-clear">
            <li class="nav-item dl-selected"><div class="nav-item-inner nav-home">首页</div></li>
            <li class="nav-item"><div class="nav-item-inner nav-order">商品</div></li>
            <li class="nav-item"><div class="nav-item-inner nav-inventory">会员</div></li>
            <li class="nav-item"><div class="nav-item-inner nav-supplier">详情页</div></li>
            <li class="nav-item"><div class="nav-item-inner nav-marketing">图表</div></li>
        </ul>
    </div>
    <ul id="J_NavContent" class="dl-tab-conten">

    </ul>
</div>
<?= Html::jsFile('public/backend/js/jquery-1.8.1.min.js')?>
<?= Html::jsFile('public/backend/js/bui-min.js')?>
<?= Html::jsFile('public/backend/js/config.js')?>
<script>

    var test="<?= Yii::$app->urlManager->createUrl('default/welcome')?>";

    BUI.use('common/main',function(){
        var config = [
            {
                id:'menu',
                homePage : 'main_menu',
                menu:[
                    {
                        text:'后台首页',
                        items:[
                            {id:'main_menu',text:'后台首页',href:"<?= Yii::$app->urlManager->createUrl('default/main')?>",closeable : false},
                        ]
                    },
                    {
                        text:'网站管理',
                        items:[
                            {id:'site_setting',text:'网站设置',href:"<?= Yii::$app->urlManager->createUrl('default/welcome')?>"},
                            {id:'frontend_theme',text:'网站前台主题',href:'main/operation.html'},
                            {id:'backend_theme',text:'网站后台主题',href:'main/operation.html'},
                            {id:'business_theme',text:'商家管理主题',href:'main/operation.html'}
                        ]
                    },
                    {
                        text:'支付方式',
                        items:[
                            {id:'payment_way',text:'支付方式',href:'main/resource.html'}
                        ]
                    },
                    {
                        text:'第三方平台',
                        items:[
                            {id:'operation',text:'oauth登录列表',href:'main/operation.html'},
                            {id:'operation',text:'手机短信平台',href:'main/operation.html'}
                        ]
                    },
                    {
                        text:'配送管理',
                        items:[
                            {id:'operation',text:'配送方式',href:'main/operation.html'},
                            {id:'operation',text:'物流公司',href:'main/operation.html'},
                            {id:'operation',text:'自提点列表',href:'main/operation.html'},
                            {id:'operation',text:'添加自提点',href:'main/operation.html'}
                        ]
                    },
                    {
                        text:'地域管理',
                        items:[
                            {id:'area_list',text:'地区列表',href:'main/operation.html'}
                        ]
                    },
                    {
                        text:'权限管理',
                        items:[
                            {id:'admin',text:'管理员',href:'main/operation.html'},
                            {id:'role',text:'角色',href:'main/operation.html'},
                            {id:'resource',text:'权限资源',href:'main/operation.html'}
                        ]
                    },
                ]
            },
            {
                id:'good',
                menu:[
                    {
                        text:'商品管理',
                        items:[
                            {id:'good_list',text:'商品列表',href:'<?= Yii::$app->urlManager->createUrl('good/list')?>'},
                            {id:'good_add',text:'商品添加',href:'<?= Yii::$app->urlManager->createUrl('good/add')?>'}
                        ]
                    },
                    {
                        text:'商品分类',
                        items:[
                            {id:'category_list',text:'分类列表',href:'<?= Yii::$app->urlManager->createUrl('category/list')?>'},
                            {id:'category_add',text:'添加分类',href:'<?= Yii::$app->urlManager->createUrl('category/add')?>'},
                            {id:'category_attr',text:'关联属性',href:'<?= Yii::$app->urlManager->createUrl('category/category-attr-map')?>'},
                            {id:'category_attr_value',text:'关联属性值',href:'<?= Yii::$app->urlManager->createUrl('category/category-attr-val-map')?>'}
                        ]
                    },
                    {
                        text:'属性管理',
                        items:[
                            {id:'list_attr',text:'属性列表',href:'<?= Yii::$app->urlManager->createUrl('attr/list')?>'},
                            {id:'add_attr',text:'添加属性',href:'<?= Yii::$app->urlManager->createUrl('attr/add')?>'},
                            {id:'add_attr_value',text:'属性值列表',href:'<?= Yii::$app->urlManager->createUrl('attr/list-attr-val')?>'},
                            {id:'list_attr_value',text:'添加属性值',href:'<?= Yii::$app->urlManager->createUrl('attr/add-attr-val')?>'}
                        ]
                    },
                    {
                        text:'品牌管理',
                        items:[
                            {id:'list_brand',text:'品牌列表',href:'<?= Yii::$app->urlManager->createUrl('attr/list-brand')?>'},
                            {id:'add_brand',text:'添加品牌',href:'<?= Yii::$app->urlManager->createUrl('attr/add-brand')?>'},
                        ]
                    },
                    {
                        text:'模型管理',
                        items:[
                            {id:'model_list',text:'模型列表',href:'form/success.html'},
                            {id:'guige_list',text:'规格列表',href:'form/fail.html'},
                            {id:'guige_img',text:'规格图库',href:'form/fail.html'}

                        ]
                    },
                    {
                        text:'搜索管理',
                        items:[
                            {id:'keyword_list',text:'关键字列表',href:'form/success.html'},
                            {id:'search_stat',text:'搜索统计',href:'form/fail.html'}
                        ]
                    },
                ]
            },
            {
                id:'member',
                menu:[
                    {
                        text:'会员管理',
                        items:[
                            {id:'member_list',text:'会员列表',href:'search/code.html'},
                            {id:'member_group',text:'会员组列表',href:'search/example.html'},
                            {id:'member_money',text:'会员提现管理',href:'search/example-dialog.html'},
                            {id:'member_notice',text:'会员消息',href:'search/introduce.html'}
                        ]
                    },
                    {
                        text : '商户管理',
                        items : [
                            {id : 'business_list',text : '商户列表',href : 'search/tab.html'},
                            {id : 'business_add',text : '添加商户',href : 'search/tab.html'},
                            {id : 'business_notice',text : '商户消息',href : 'search/tab.html'}
                        ]
                    },
                    {
                        text : '消息管理',
                        items : [
                            {id : 'advice_manage',text : '建议管理',href : 'search/tab.html'},
                            {id : 'counsel_manage',text : '咨询管理',href : 'search/tab.html'},
                            {id : 'discuss_manage',text : '讨论管理',href : 'search/tab.html'},
                            {id : 'evaluate_manage',text : '评价管理',href : 'search/tab.html'},
                            {id : 'arrival_notice',text : '到货通知',href : 'search/tab.html'},
                            {id : 'email_notice',text : '邮件订阅',href : 'search/tab.html'},
                            {id : 'sms_marketing',text : '营销短信',href : 'search/tab.html'},
                        ]
                    }
                ]
            },
            {
            id:'detail',
            menu:[{
                text:'详情页面',
                items:[
                    {id:'code',text:'详情页面代码',href:'detail/code.html'},
                    {id:'example',text:'详情页面示例',href:'detail/example.html'},
                    {id:'introduce',text:'详情页面简介',href:'detail/introduce.html'}
                ]
            }]
        },{
            id : 'chart',
            menu : [{
                text : '图表',
                items:[
                    {id:'code',text:'引入代码',href:'chart/code.html'},
                    {id:'line',text:'折线图',href:'chart/line.html'},
                    {id:'area',text:'区域图',href:'chart/area.html'},
                    {id:'column',text:'柱状图',href:'chart/column.html'},
                    {id:'pie',text:'饼图',href:'chart/pie.html'},
                    {id:'radar',text:'雷达图',href:'chart/radar.html'}
                ]
            }]
        }];
        new PageUtil.MainPage({
            modulesConfig : config
        });
    });
</script>
<div style="text-align:center;">
    <p>来源：<a href="http://www.mycodes.net/" target="_blank">吴桢灿</a></p>
</div>
</body>
</html>
