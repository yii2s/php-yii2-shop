<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '会员注册';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin([
                'id'                   => 'form-signup',
                'action'               => Yii::$app->urlManager->createUrl(['member/signup']),
                'enableAjaxValidation' => true,
                'validationUrl'        => Yii::$app->urlManager->createUrl(['member/validate']),
            ]); ?>
                <?= $form->field($model, 'username')->label('用户名') ?>
                <?= $form->field($model, 'nickname')->label('昵称') ?>
                <?= $form->field($model, 'email')->label('邮箱') ?>
                <?= $form->field($model, 'phone')->label('手机号') ?>
                <?= $form->field($model, 'password')->passwordInput()->label('密码') ?>
                <?= $form->field($model, 'password2')->passwordInput()->label('确认密码') ?>
                <?= $form->field($model, 'sex')->dropDownList(['0'=>'保密','1'=>'男','2'=>'女'], ['prompt'=>'请选择','style'=>'width:120px'])->label('性别') ?>
                <div class="form-group">
                    <?= Html::submitButton('立即注册', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
