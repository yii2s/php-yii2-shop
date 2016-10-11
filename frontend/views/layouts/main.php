<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\ActiveForm;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <?= Html::cssFile('public/frontend/css/site.css')?>
    <?= Html::cssFile('public/frontend/menu1/css/zzsc.css')?>
    <?php $this->registerJsFile('@web/public/frontend/menu1/js/zzsc.js',['depends' => \yii\web\JqueryAsset::className()])?>
    <!--[if lt IE 9]>
    <script src="//cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <![endif]-->
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap" style="background-color: #F5F5F5">

    <nav id="w0" class="navbar-inverse navbar-fixed-top navbar" style="">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#w0-collapse"><span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="header_nav_subnav1">
                    <div id="Z_TypeList" class="Z_TypeList">
                        <h1 class="title"><a href="<?= Yii::$app->urlManager->createUrl(['site/index']); ?>">zc商城系统</a></h1>
                        <div class="Z_MenuList">
                            <ul class="Z_MenuList_ul">
                                <li class="list-item0 alt">
                                    <h3><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">整形美容</a></h3>
                                    <p> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">眼部</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">鼻部</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">面部</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">胸部</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">吸脂</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">自体脂肪移植</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">耳部</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">私密整形</a> </p>
                                </li>
                                <li class="list-item1">
                                    <h3><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">皮肤美容</a></h3>
                                    <p> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">祛斑</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">祛痘祛印</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">美白嫩肤</a> </p>
                                    <p> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">除皱</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">紧肤</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">脱毛</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">除腋臭</a> </p>
                                </li>
                                <li class="list-item2 alt">
                                    <h3><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">注射美容</a></h3>
                                    <p> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">除皱</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">填充</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">瘦脸</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">瘦腿</a></p>
                                    <p><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">手背美容</a> </p>
                                </li>
                                <li class="list-item3">
                                    <h3><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">口腔美容</a></h3>
                                    <p> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">种植牙</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">烤瓷牙</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">牙齿美白</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">美容冠</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">牙齿矫正</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">补牙</a> </p>
                                </li>
                                <li class="list-item4 alt">
                                    <h3><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">毛发移植</a></h3>
                                    <p> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">植发</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">植眉毛</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">植睫毛</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">植鬓角</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">植胡须</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">发际线</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">植美人尖</a> </p>
                                </li>
                            </ul>
                        </div>
                        <div class="Z_SubList">
                            <div class="subView">
                                <ul class="Z_SubList_ul">
                                    <li class="subItem">
                                        <h4 class="subItem-title"><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">眼部整形</a></h4>
                                        <p class="subItem-cat"> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">双眼皮</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">双眼皮修复术</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">祛眼袋</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">开外眼角</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">开内眼角</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">眼皮下垂</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">眼皮松弛</a> <a class="block1190 none980" href="/shangxiayanjianaoxian/" target="_blank">上下眼睑凹陷</a> <a class="block1190 none980" href="/web_htm/yuwei/" target="_blank">祛鱼尾纹</a> <a class="block1190 none980" href="/tms/" target="_blank">提眉</a> <a class="navgd" href="/web_htm/east_hans/" target="_blank">更多</a> </p>
                                        <h4 class="subItem-title"><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">鼻部整形</a></h4>
                                        <p class="subItem-cat"> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">隆鼻术</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">假体隆鼻</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">膨体隆鼻</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">自体软骨隆鼻</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">注射隆鼻</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">鼻尖整形</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">鼻翼整形</a> <a class="block1190 none980" href="/web_htm/ygou/" target="_blank">鹰钩鼻整形</a> <a class="block1190 none980" href="/web_htm/tfen/" target="_blank">驼峰鼻整形</a> <a class="block1190 none980" href="/lbsbxf/" target="_blank">隆鼻失败修复</a> <a class="navgd"  href="/web_htm/east_biz/" target="_blank">更多</a> </p>
                                        <h4 class="subItem-title"><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">面部整形</a></h4>
                                        <p class="subItem-cat"> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">改脸型</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">下颌角整形</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">颧骨整形</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">下巴整形</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">咬肌肥大矫正</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">丰太阳穴</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">双下巴吸脂</a> <a class="block1190 none980" href="/fengmianjia/" target="_blank">丰面颊</a> <a class="block1190 none980" href="/ztzffet/" target="_blank">自体脂肪丰额头</a> <a class="block1190 none980" href="/mianbuchuzhou/" target="_blank">面部除皱</a> <a class="navgd"  href="/web_htm/east_xe/" target="_blank">更多</a> </p>
                                        <h4 class="subItem-title"><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">乳房整形</a></h4>
                                        <p class="subItem-cat"> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">假体隆胸</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">自体脂肪隆胸</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">丰胸方法</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">乳房下垂上提</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">乳头内陷矫正</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">不良隆胸修复</a> <a class="block1190 none980" href="/web_htm/suo/" target="_blank">巨型乳房缩小</a> <a class="block1190 none980" href="/furuquchu/" target="_blank">副乳祛除</a> <a class="block1190 none980" href="/web_htm/xuan/" target="_blank">乳晕炫色</a> <a class="navgd"  href="/web_htm/east_rufa/" target="_blank">更多</a> </p>
                                        <h4 class="subItem-title"><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">吸脂塑身</a></h4>
                                        <p class="subItem-cat"> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">腰部吸脂</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">胸部吸脂</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">腹部吸脂</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">脸部吸脂</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">手臂吸脂</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">大腿吸脂</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">小腿吸脂</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">臀部吸脂</a> <a class="block1190 none980" href="/web_htm/bei/" target="_blank">背部吸脂</a> <a class="block1190 none980" href="/chxz/" target="_blank">产后吸脂</a> <a class="navgd"  href="/web_htm/east_xizi/" target="_blank">更多</a> </p>
                                        <h4 class="subItem-title"><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">自体脂肪移植</a></h4>
                                        <p class="subItem-cat"> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">自体脂肪除皱</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">自体脂肪丰臀</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">O型腿矫正</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">自体脂肪隆胸</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">自体脂肪丰额头</a> <a class="block1190 none980" href="/zhifanglongbi/" target="_blank">自体脂肪隆鼻</a> <a class="block1190 none980" href="/taiyangxue/" target="_blank">自体脂肪丰太阳穴</a> <a class="navgd"  href="/zitizhifang/" target="_blank">更多</a> </p>
                                        <h4 class="subItem-title"><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">耳部整形</a></h4>
                                        <p class="subItem-cat"> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">外耳畸形</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">耳垂畸形矫正</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">耳廓缺损修复</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">耳再造术</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">耳整形术</a> <a class="navgd"  href="/erbuzhengxing/" target="_blank">更多</a> </p>
                                        <h4 class="subItem-title"><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">私密整形</a></h4>
                                        <p class="subItem-cat"> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">处女膜修复</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">阴道紧缩术</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">阴唇肥大整形</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">外阴整形术</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">阴蒂整形</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">阴道再造术</a> <a class="block1190 none980" href="/yinjingyanchang/" target="_blank">阴茎延长</a> <a class="navgd"  href="/web_htm/east_szhi/" target="_blank">更多</a> </p>
                                    </li>
                                </ul>
                                <dl class="dlbanner_zdy">
                                    <dt class="titlemb">热门项目</dt>
                                    <dd>
                                        <div class="object_banner1">
                                            <ul>
                                                <li><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank"><img src="public/frontend/menu1/img/idnex_syp.jpg" width="212" height="354"></a></li>
                                            </ul>
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                            <div class="subView">
                                <ul class="Z_SubList_ul">
                                    <li class="subItem" >
                                        <h4 class="subItem-title"><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">美白嫩肤</a></h4>
                                        <p class="subItem-cat"> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">光子嫩肤</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">美白疗法</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">白瓷娃娃</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">黑脸娃娃</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">皮肤暗沉</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">微针美塑</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">皮肤粗糙</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">毛孔粗大</a> <a class="block1190 none980" href="/web_htm/othery/" target="_blank">黑眼圈</a> <a class="block1190 none980" href="/quheitou/" target="_blank">黑头清理</a> <a class="none1190 block2980 navgd" href="/web_htm/east_caig/" target="_blank">更多</a> </p>
                                        <h4 class="subItem-title"><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">紧肤提升</a></h4>
                                        <p class="subItem-cat"> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">眼部松弛</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">颈部松弛</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">面颈部松弛</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">下面部松弛</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">双下巴</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">腰腹部松弛</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">四肢松弛</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">皮肤松弛</a> </p>
                                        <h4 class="subItem-title"><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">冰点脱毛</a></h4>
                                        <p class="subItem-cat"> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">发际线修整</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">冰点专家脱毛</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">腋毛</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">唇毛</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">腿毛</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">手臂毛</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">比基尼毛</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">男士脱毛</a> </p>
                                        <h4 class="subItem-title"><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">祛斑</a></h4>
                                        <p class="subItem-cat"> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">黄褐斑</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">雀斑</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">疤痕</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">胎记</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">妊娠斑</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">晒斑</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">老年斑</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">汗斑</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">祛痣</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">太田痣</a> </p>
                                        <h4 class="subItem-title"><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">射频除皱</a></h4>
                                        <p class="subItem-cat"> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">面部除皱</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">肥胖纹</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">鱼尾纹</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">妊娠纹</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">抬头纹</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">法令纹</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">泪沟纹</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">颈纹</a> </p>
                                        <h4 class="subItem-title"><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">祛痘祛印</a></h4>
                                        <p class="subItem-cat"> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">青春痘</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">痘疤</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">痘印</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">痘坑</a> </p>
                                        <h4 class="subItem-title"><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">血管性症状</a></h4>
                                        <p class="subItem-cat"> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">鲜红斑痣</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">血管瘤</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">祛红血丝</a> </p>
                                        <h4 class="subItem-title"><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">祛腋臭</a></h4>
                                        <p class="subItem-cat"> </p>
                                        <h4 class="subItem-title"><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">中医减肥</a></h4>
                                        <p class="subItem-cat"> </p>
                                        <div class="subItemimg1"> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank"> <img src="public/frontend/menu1/img/subItemimg2.jpg" width="289" height="259"> </a> </div>
                                    </li>
                                </ul>
                                <dl class="dlbanner_zdy">
                                    <dt class="titlemb">热门项目</dt>
                                    <dd>
                                        <div class="object_banner2">
                                            <ul>
                                                <li><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank"><img src="public/frontend/menu1/img/idnex_nf.jpg" width="212" height="354"></a></li>
                                            </ul>
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                            <div class="subView">
                                <ul class="Z_SubList_ul">
                                    <li class="subItem">
                                        <div class="nav50">
                                            <h4 class="subItem-title"><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">面部填充</a></h4>
                                            <p class="subItem-cat"> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">丰额头</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">丰苹果肌</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">丰眉弓</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">注射丰胸</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">丰耳垂</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">填充泪沟</a><br/>
                                                <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">丰唇</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">丰太阳穴</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">丰下巴</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">丰面颊</a> </p>
                                        </div>
                                        <div class="nav50">
                                            <h4 class="subItem-title"><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">注射除皱</a></h4>
                                            <p class="subItem-cat"> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">嘴角纹</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">颈纹</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">眉川纹</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">鱼尾纹</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">抬头纹</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">法令纹</a> </p>
                                        </div>
                                        <div class="gclear"><!--如果有class="nav50"那么就使用--></div>
                                        <div class="nav50">
                                            <h4 class="subItem-title"><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">注射材料</a></h4>
                                            <p class="subItem-cat"> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">胶原蛋白</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">玻尿酸</a> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">BOTOX</a> </p>
                                        </div>
                                        <div class="nav50" style="width: 13%; margin: 0px 10px 0px 0px;">
                                            <h4 class="subItem-title"><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">注射瘦脸</a></h4>
                                            <p class="subItem-cat"> </p>
                                        </div>
                                        <div class="nav50" style="width: 13%; margin: 0px 10px 0px 0px;">
                                            <h4 class="subItem-title"><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">注射瘦腿</a></h4>
                                            <p class="subItem-cat"> </p>
                                        </div>
                                        <div class="nav50" style="width: 13%; margin: 0px 10px 0px 0px;">
                                            <h4 class="subItem-title"><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">手背美容</a></h4>
                                            <p class="subItem-cat"> </p>
                                        </div>
                                        <div class="gclear"><!--如果有class="nav50"那么就使用--></div>
                                        <div class="subItemimg2"> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">
                                                <img src="public/frontend/menu1/img/subItemimg1980.jpg" width="500" height="231" class="none1190 block2980"></a>
                                        </div>
                                    </li>
                                </ul>
                                <dl>
                                    <dt class="titlemb">热门项目</dt>
                                    <dd>
                                        <div class="object_banner3">
                                            <ul>
                                                <li><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank"><img src="public/frontend/menu1/img/idnex_owc.jpg" width="212" height="354"></a></li>
                                            </ul>
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                            <div class="subView">
                                <ul class="Z_SubList_ul">
                                    <li class="subItem" id="subItemh4">
                                        <h4 class="subItem-title"><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">美容冠</a></h4>
                                        <h4 class="subItem-title"><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">种植牙</a></h4>
                                        <h4 class="subItem-title"><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">补牙</a></h4>
                                        <h4 class="subItem-title"><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">牙贴面</a></h4>
                                        <h4 class="subItem-title"><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">烤瓷牙</a></h4>
                                        <h4 class="subItem-title"><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">老年义齿</a></h4>
                                        <h4 class="subItem-title"><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">牙齿矫正</a></h4>
                                        <h4 class="subItem-title"><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">牙齿美白</a></h4>
                                        <h4 class="subItem-title"><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">牙齿修复</a></h4>
                                        <h4 class="subItem-title"><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">洗牙</a></h4>
                                        <h4 class="subItem-title"><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">牙周疾病</a></h4>
                                        <h4 class="subItem-title"><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">牙齿保健</a></h4>
                                        <h4 class="subItem-title"><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">其它口腔美容</a></h4>
                                        <div class="subItemimg3"> <a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">
                                                <img src="public/frontend/menu1/img/subItemimg3980.jpg" width="477" height="303" class="none1190 block2980">
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                                <dl>
                                    <dt class="titlemb">热门项目</dt>
                                    <dd>
                                        <div class="object_banner4">
                                            <ul>
                                                <li><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank"><img src="public/frontend/menu1/img/idnex_ycjz.jpg" width="212" height="354"></a></li>
                                            </ul>
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                            <div class="subView">
                                <ul class="Z_SubList_ul">
                                    <li class="subItem" id="subItemh4">
                                        <h4 class="subItem-title"><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">头发种植</a></h4>
                                        <h4 class="subItem-title"><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">眉毛种植</a></h4>
                                        <h4 class="subItem-title"><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">睫毛种植</a></h4>
                                        <h4 class="subItem-title"><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">胡须种植</a></h4>
                                        <h4 class="subItem-title"><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">鬓角种植</a></h4>
                                        <h4 class="subItem-title"><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">疤痕植发</a></h4>
                                        <h4 class="subItem-title"><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">发际线调整</a></h4>
                                        <h4 class="subItem-title"><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">美人尖种植</a></h4>
                                        <h4 class="subItem-title"><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">阴毛种植</a></h4>
                                        <div class="subItemimg4"><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank">
                                                <img src="public/frontend/menu1/img/subItemimg4980.jpg" width="516" height="265" class="none1190 block2980">
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                                <dl>
                                    <dt class="titlemb">热门项目</dt>
                                    <dd>
                                        <div class="object_banner5">
                                            <ul>
                                                <li><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>" target="_blank"><img src="public/frontend/menu1/img/idnex_zfs.jpg" width="212" height="354"></a></li>
                                            </ul>
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="w0-collapse" class="collapse navbar-collapse">
                <ul id="w1" class="navbar-nav navbar-right nav">

                    <!--搜索框start-->
                    <form class="navbar-form navbar-left" role="search" style="margin: 0" action="<?= Yii::$app->urlManager->createUrl(['goods/search'])?>" method="post">
                        <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken()?>">
                        <div class="form-group">
                            <label class="sr-only"></label>
                            <input type="text" class="form-control" name="keyword" placeholder="搜索" style="width: 200px"/>
                        </div>
                        <button type="submit" class="btn btn-default navbar-btn">搜索</button>
                    </form>
                    <!--搜索框end-->

                    <li><a href="<?= Yii::$app->urlManager->createUrl(['goods/list','cid'=>4]); ?>">列表</a></li>
                    <li class="active"><a href="<?= Yii::$app->urlManager->createUrl(['site/index']); ?>">主页</a></li>
                    <li><a href="<?= Yii::$app->urlManager->createUrl(['site/about']); ?>">详情</a></li>
                    <li><a href="<?= Yii::$app->urlManager->createUrl(['site/contact']); ?>">联系</a></li>
                    <?php if (Yii::$app->member->getIsGuest()) { ?>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['member/login']); ?>">登录</a></li>
                    <?php } else { ?>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['member/index']); ?>">会员中心(<?= Yii::$app->member->identity->username?>)</a></li>
                    <?php } ?>
                    <li><a href="admin.php" target="_blank">后台管理</a></li>
                    <li><a href="<?= Yii::$app->urlManager->createUrl(['member/logout']); ?>" data-method="post">退出</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container" style="width: 100%;">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer" style="background-color: #ffffff">
    <div class="container">
        <p class="pull-left">&copy; zc商城系统 <?= date('Y') ?></p>

        <p class="pull-right">Powered by wuzhc</p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
