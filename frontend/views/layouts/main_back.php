<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
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
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap" style="background-color: #F5F5F5">
    <?php
    NavBar::begin([
        'brandLabel' => '<strong style=""color:#fff">zc商城系统</strong>',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
            'style' => ''
        ]
    ]);
    $menuItems = [
        ['label' => '列表', 'url' => ['/goods/list','cid' => 4]],
        ['label' => '主页', 'url' => ['/site/index']],
        ['label' => '详情', 'url' => ['/site/about']],
        ['label' => '联系', 'url' => ['/site/contact']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => '注册', 'url' => ['/member/signup']];
        $menuItems[] = ['label' => '登录', 'url' => ['/member/login']];
    } else {
        $menuItems[] = [
            'label' => '会员中心(' . Yii::$app->user->identity->nickname . ')',
            'url' => ['/member/index']
        ];
        $menuItems[] = [
            'label' => '后台管理',
            'url' => 'admin.php'
        ];
        $menuItems[] = [
            'label' => '退出',
            'url' => ['/member/logout'],
            'linkOptions' => ['data-method' => 'post']
        ];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>


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
