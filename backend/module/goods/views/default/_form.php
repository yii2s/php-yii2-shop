<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Goods */
/* @var $form yii\widgets\ActiveForm */


$fieldTemplate = "<div class=\"col-sm-1\">{label}</div>\n<div class=\"col-sm-7\">{input}</div>\n<div class=\"col-sm-2\">{hint}\n{error}</div>";

?>

<div>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#base-info" aria-controls="base-info" role="tab" data-toggle="tab">基本信息</a></li>
            <li role="presentation"><a href="#seo-set" aria-controls="profile" role="tab" data-toggle="tab">SEO设置</a></li>
            <li role="presentation"><a href="#goods-imgs" aria-controls="messages" role="tab" data-toggle="tab">商品相册</a></li>
            <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab"></a></li>
        </ul>

        <div class="goods-form" style="margin-top: 20px">
            <?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal', 'role' => 'form'], 'fieldConfig' => ['template' => $fieldTemplate]]); ?>
            <!-- Tab panes -->
            <div class="tab-content">

                <!--基本信息-->
                <div role="tabpanel" class="tab-pane active" id="base-info">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => '名称', 'style' => 'width:80%'])->label('商品名称：') ?>
                    <?= $form->field($model, 'goods_no')->textInput(['maxlength' => true, 'placeholder' => '000000', 'style' => 'width:20%'])->label('商品编号：') ?>
                    <?= $form->field($model, 'sell_price')->textInput(['maxlength' => true, 'placeholder' => '0.0', 'style' => 'width:20%'])->label('销售价格：') ?>
                    <?= $form->field($model, 'market_price')->textInput(['maxlength' => true, 'placeholder' => '0.0', 'style' => 'width:20%'])->label('市场价格：') ?>
                    <?= $form->field($model, 'cost_price')->textInput(['maxlength' => true, 'placeholder' => '0.0', 'style' => 'width:20%'])->label('成本价格：') ?>
                    <?/*= $form->field($model, 'create_time')->textInput(['readonly' => true]) */?>
                    <?= $form->field($model, 'store_nums')->textInput(['style' => 'width:20%', 'value' => 999])->label('库存：') ?>
                    <?= $form->field($model, 'brand_id')->dropDownList(['7' => '爱丽丝', '8' => '耐克'], ['style' => 'width:30%'])->label('品牌') ?>
                    <?= $form->field($model, 'weight')->textInput(['maxlength' => true, 'placeholder' => '数字 + 单位', 'style' => 'width:20%'])->label('重量：') ?>
                    <?= $form->field($model, 'visit')->textInput(['style' => 'width:20%', 'value' => 1])->label('访问数：') ?>
                    <?= $form->field($model, 'favorite')->textInput(['style' => 'width:20%', 'value' => 1])->label('收藏数：') ?>
                    <?= $form->field($model, 'sort')->textInput(['style' => 'width:20%', 'value' => 0])->label('排序：') ?>
                    <?= $form->field($model, 'comments')->textInput(['style' => 'width:20%', 'value' => 0])->label('评论数：') ?>
                    <?= $form->field($model, 'is_del')->radioList(Yii::$app->params['goodsStatus'])->label('状态') ?>
                    <div class="form-group">
                        <div class="col-sm-1"><label class="control-label" for="goods-market_price">内容：</label></div>
                        <div class="col-sm-7"> <?= \common\widgets\WangEditorWidget::widget(['model' => $model])?></div>
                    </div>
                </div>

                <!--SEO设置-->
                <div role="tabpanel" class="tab-pane" id="seo-set">
                    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true, 'placeholder' => '多个关键字之间用逗号隔开',])->label('关键字：') ?>
                    <?= $form->field($model, 'description')->textarea(['rows' => 5, 'cols' => 10])->label('描述：') ?>
                </div>

                <!--商品相册-->
                <div role="tabpanel" class="tab-pane" id="goods-imgs">
                    <?= \common\widgets\UploadWidget::widget(['model' => $model]); ?>
                </div>

                <div role="tabpanel" class="tab-pane" id="settings"></div>
            </div>

            <div class="form-group" style="margin-left: 20px">
                <?= Html::submitButton($model->isNewRecord ? '确定添加' : '确定更新', ['id' => 'submit-goods','class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>

    </div>



<!-- Button trigger modal -->
<!--<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
    Launch demo modal
</button>-->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Recipient:</label>
                        <input type="text" class="form-control" id="recipient-name">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label">Message:</label>
                        <textarea class="form-control" id="message-text"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>



<?php Html::jsFile('public/backend/js/goods/goods.js')?>