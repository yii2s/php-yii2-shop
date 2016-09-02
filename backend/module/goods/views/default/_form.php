<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Goods */
/* @var $form yii\widgets\ActiveForm */


$fieldTemplate = "{label}\n<div class=\"col-sm-8\">{input}</div>\n<div class=\"col-sm-3\">{hint}\n{error}</div>";

?>
<style>

</style>
<div class="box box-primary">
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
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => '名称', 'value'=>'呵呵哒', 'style' => 'width:80%'])->label('商品名称:',['class' => 'col-sm-1 control-label']) ?>
                    <?= $form->field($model, 'goods_no')->textInput(['maxlength' => true, 'placeholder' => '000000', 'value'=>12, 'style' => 'width:20%'])->label('商品编号:',['class' => 'col-sm-1 control-label']) ?>
                    <?= $form->field($model, 'sell_price')->textInput(['maxlength' => true, 'placeholder' => '0.0', 'value'=>12, 'style' => 'width:20%'])->label('销售价格:',['class' => 'col-sm-1 control-label']) ?>
                    <?= $form->field($model, 'market_price')->textInput(['maxlength' => true, 'placeholder' => '0.0', 'style' => 'width:20%'])->label('市场价格:',['class' => 'col-sm-1 control-label']) ?>
                    <?= $form->field($model, 'cost_price')->textInput(['maxlength' => true, 'placeholder' => '0.0', 'style' => 'width:20%'])->label('成本价格:',['class' => 'col-sm-1 control-label']) ?>
                    <?= $form->field($model, 'store_nums')->textInput(['style' => 'width:20%', 'value' => 999])->label('库存:',['class' => 'col-sm-1 control-label']) ?>
                    <?= $form->field($model, 'brand_id')->dropDownList(['7' => '爱丽丝', '8' => '耐克'], ['style' => 'width:20%'])->label('品牌',['class' => 'col-sm-1 control-label']) ?>
                    <?= $form->field($model, 'weight')->textInput(['maxlength' => true, 'placeholder' => '数字 + 单位', 'style' => 'width:20%'])->label('重量:',['class' => 'col-sm-1 control-label']) ?>
                    <?= $form->field($model, 'visit')->textInput(['style' => 'width:20%', 'value' => 1])->label('访问数:',['class' => 'col-sm-1 control-label']) ?>
                    <?= $form->field($model, 'favorite')->textInput(['style' => 'width:20%', 'value' => 1])->label('收藏数:',['class' => 'col-sm-1 control-label']) ?>
                    <?= $form->field($model, 'sort')->textInput(['style' => 'width:20%', 'value' => 0])->label('排序:',['class' => 'col-sm-1 control-label']) ?>
                    <?= $form->field($model, 'comments')->textInput(['style' => 'width:20%', 'value' => 0])->label('评论数:',['class' => 'col-sm-1 control-label']) ?>
                    <?= $form->field($model, 'is_del')->radioList(Yii::$app->params['goodsStatus'])->label('状态',['class' => 'col-sm-1 control-label']) ?>

                    <div class="form-group">
                        <label class="control-label col-sm-1" for="goods-content">规格值:</label>
                        <div class="col-sm-10">
                            <div class="panel panel-default">
                                <div class="panel-heading">面板标题</div>
                                <table class="table">
                                    <th>产品</th><th>商品编号</th><th>库存</th><th>市场价格</th><th>销售价格</th><th>成本价格</th><th>重量</th>
                                    <tr>
                                        <td>蓝色，木质，<img src="public/backend/img/chart.png" width="50" height="50"></td>
                                        <td><input type="text" name="products_no" value="" size="7"></td>
                                        <td><input type="text" name="store_nums" value="" size="7"></td>
                                        <td><input type="text" name="market_price" value="" size="7"></td>
                                        <td><input type="text" name="sell_price" value="" size="7"></td>
                                        <td><input type="text" name="cost_price" value="" size="7"></td>
                                        <td><input type="text" name="weight" value="" size="7"></td>
                                    </tr>
                                    <tr>
                                        <td>蓝色，木质，套餐二</td>
                                        <td><input type="text" name="products_no" value="" size="7"></td>
                                        <td><input type="text" name="store_nums" value="" size="7"></td>
                                        <td><input type="text" name="market_price" value="" size="7"></td>
                                        <td><input type="text" name="sell_price" value="" size="7"></td>
                                        <td><input type="text" name="cost_price" value="" size="7"></td>
                                        <td><input type="text" name="weight" value="" size="7"></td>
                                    </tr>
                                    <tr>
                                        <td>蓝色，木质，套餐二</td>
                                        <td><input type="text" name="products_no" value="" size="7"></td>
                                        <td><input type="text" name="store_nums" value="" size="7"></td>
                                        <td><input type="text" name="market_price" value="" size="7"></td>
                                        <td><input type="text" name="sell_price" value="" size="7"></td>
                                        <td><input type="text" name="cost_price" value="" size="7"></td>
                                        <td><input type="text" name="weight" value="" size="7"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-1" for="goods-content">内容:</label>
                        <div class="col-sm-10"> <?= \common\widgets\WangEditorWidget::widget(['model' => $model])?></div>
                    </div>
                </div>

                <!--SEO设置-->
                <div role="tabpanel" class="tab-pane" id="seo-set">
                    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true, 'placeholder' => '多个关键字之间用逗号隔开',])->label('关键字:',['class' => 'col-sm-1 control-label']) ?>
                    <?= $form->field($model, 'description')->textarea(['rows' => 5, 'cols' => 10])->label('描述:',['class' => 'col-sm-1 control-label']) ?>
                </div>

                <!--商品相册-->
                <div role="tabpanel" class="tab-pane" id="goods-imgs">
                    <div class="form-group">
                        <label class="control-label col-sm-1" for="goods-ad-img">封面:</label>
                        <div class="col-sm-10">
                            <?= \common\widgets\UploadWidget::widget([
                                'hiddenField' => Html::getInputName($model, 'img'),
                                'id' => 'img-1'
                            ]); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-1" for="goods-ad-img">图集:</label>
                        <div class="col-sm-10">
                            <?= \common\widgets\UploadWidget::widget([
                                'hiddenField' => Html::getInputName($model, 'images[]'),
                                'multiple' => true,
                                'maxFileCount' => 20,
                                'dropZoneEnabled' => 1
                            ]); ?>
                        </div>
                    </div>
                </div>

                <div role="tabpanel" class="tab-pane" id="settings"></div>
            </div>

            <div class="box-footer">
                <?= Html::submitButton($model->isNewRecord ? '确定添加' : '确定更新', ['id' => 'submit-goods','class' => $model->isNewRecord ? 'btn btn-success pull-right' : 'btn btn-primary pull-right']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>

    </div>



<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
    Launch demo modal
</button>
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#specModal">
    添加规格
</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="<?= Yii::$app->urlManager->createUrl(['/goods/default/addSpec'])?>">
                    <div class="form-group">
                        <label for="spec-name" class="control-label">规格名称:</label>
                        <input type="text" class="form-control" id="spec-name" name="">
                    </div>
                    <div class="form-group">
                        <label for="spec-type" class="control-label">类型:</label>
                        <input type="radio" name="type" class="spec-type" value="1" checked>输入框
                        <input type="radio" name="type" class="spec-type" value="2">图片
                    </div>
                    <div class="form-group">
                        <label for="spec-value" class="control-label">规格值:</label>
                        <div class="spec-text hide">
                            <textarea class="form-control" name="spec_text" id="message-text" placeholder="多个值用逗号隔开"></textarea>
                        </div>
                        <div class="spec-img hide">
                            <?= \common\widgets\UploadWidget::widget([
                                'hiddenField' => 'spec_img',
                                'multiple' => true,
                                'maxFileCount' => 20,
                                'dropZoneEnabled' => 1,
                                'id' => 'spec_photo'
                            ]); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label">备注说明:</label>
                        <textarea class="form-control" id="message-text"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" id="show-spec">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="specModal" tabindex="-1" role="dialog" aria-labelledby="specModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="<?= Yii::$app->urlManager->createUrl(['/goods/default/addSpec'])?>">
                    <?php if ($specs = \common\service\CategoryService::factory()->getSpec(Yii::$app->user->id)) { ?>
                        <div class="form-group" style="text-align: right">
                            <input type="text" name="search-spec" value="" placeholder="搜索">
                            <button type="button" id="search-spec">搜索</button>
                        </div>
                        <div class="form-group spec_group" style="max-height: 300px;overflow:auto">
                            <?php foreach ($specs as $spec) { ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title spec_name"><?= $spec->name ?></h3>
                                    </div>
                                    <div class="panel-body">
                                        <?php $values = unserialize($spec->value); ?>
                                        <?php if ($spec->type == 1) { ?>
                                            <?php foreach ((array)$values as $v) { ?>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" name="spec-select" value="<?=$v?>"> <?= $v?>
                                                </label>
                                            <?php } ?>
                                        <?php } elseif ($spec->type == 2) { ?>
                                            <?php foreach ((array)$values as $v) { ?>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" name="spec-select" value="<?=$v?>"> <img src="<?=$v?>" width="40" height="40">
                                                </label>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary">确定</button>
                <button type="button" class="btn btn-primary" data-toggle="modal" id="add-spec" data-target="#myModal">新增规格</button>
            </div>
        </div>
    </div>
</div>


<?php $this->registerJsFile('public/backend/js/goods/goods.js',['depends' => \yii\web\JqueryAsset::className()])?>
