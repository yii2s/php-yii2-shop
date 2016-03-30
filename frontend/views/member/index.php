<?php
use yii\helpers\Html;

$this->title = '会员中心';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-lg-5">
            用户名：<?= Html::encode($member->username);?>  <br>
            昵称：  <?= Html::encode($member->nickname);?>  <br>
            邮箱：  <?= Html::encode($member->email);?>   <br>
            手机：  <?= Html::encode($member->phone);?>  <br>
            注册时间：    <?= Html::encode($member->createTime);?> <br>
            最后登录IP：  <?= Html::encode($member->lastIP);?>   <br>
            最后登录时间：<?= Html::encode($member->lastTime);?>  <br>
        </div>
    </div>
    <a href="<?php echo Yii::$app->urlManager->createUrl(['member/modify-pwd'])?>">修改密码</a>
</div>


