<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '修改密码';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Please fill out the following fields to login:</p>
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin([
                'id'                   => 'modifyPwd-form',
                'action'               => Yii::$app->urlManager->createUrl(['member/modify-pwd']),
                'enableAjaxValidation' => true,
                'validationUrl'        => Yii::$app->urlManager->createUrl(['member/validate-pwd']),
            ]); ?>
            <?= $form->field($model, 'oldPwd')->passwordInput()->label('原密码') ?>
            <?= $form->field($model, 'newPwd')->passwordInput()->label('新密码') ?>
            <?= $form->field($model, 'reNewPwd')->passwordInput()->label('确认密码') ?>
            <div class="form-group">
                <?= Html::submitButton('确认修改', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>


