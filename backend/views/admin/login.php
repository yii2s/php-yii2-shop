<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>欢迎登录后台管理系统</title>
<link href="./public/backend/css/style.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="./public/backend/js/jquery.js"></script>
<script src="./public/backend/js/cloud.js" type="text/javascript"></script>

<script language="javascript">
	$(function(){
    $('.loginbox').css({'position':'absolute','left':($(window).width()-692)/2});
	$(window).resize(function(){  
    $('.loginbox').css({'position':'absolute','left':($(window).width()-692)/2});
    })  
});  
</script> 
    <style>
        .help-block-error{
            height: 20px;
            color: red;
        }
        .control-label{
            height: 0px;
        }
    </style>
</head>

<body style="background-color:#df7611; background-image:url(./public/backend/images/light.png); background-repeat:no-repeat; background-position:center top; overflow:hidden;">
    <div id="mainBody">
      <div id="cloud1" class="cloud"></div>
      <div id="cloud2" class="cloud"></div>
    </div>
    <div class="logintop">
        <span>欢迎登录后台管理界面平台</span>
        <ul>
        <li><a href="./index.php">回首页</a></li>
        <li><a href="#">帮助</a></li>
        <li><a href="#">关于</a></li>
        </ul>
    </div>
    <div class="loginbody">
        <span class="systemlogo"></span>
        <div class="loginbox loginbox3">
            <ul>
                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <?= $form->field($model, 'username')->textInput(['class' => 'loginuser'])->label(false) ?>
                <?= $form->field($model, 'password')->passwordInput(['class' => 'loginpwd'])->label(false) ?>
                <li class="yzm">
                    <span>
                        <?= $form->field($model, 'captcha')->label(false) ?>
                    </span>
                    <cite>X3D5S</cite>
                </li>
                <li>
                    <?= Html::submitButton('登录', ['class' => 'loginbtn', 'name' => 'login-button']) ?>
                    <label>
                        <input name="" type="checkbox" value="" checked="checked" />记住密码
                    </label>
                    <label><a href="#">忘记密码？</a></label>
                </li>
                <?php ActiveForm::end(); ?>
            </ul>
        </div>
    </div>
    <div class="loginbm">版权所有  2014  <a href="http://www.uimaker.com">uimaker.com</a>  仅供学习交流，勿用于任何商业用途</div>
</body>

</html>
