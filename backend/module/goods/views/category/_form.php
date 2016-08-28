<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $form yii\widgets\ActiveForm */

$fieldTemplate = "<div class=\"col-sm-1\">{label}</div>\n<div class=\"col-sm-8\">{input}</div>\n<div class=\"col-sm-3\">{hint}\n{error}</div>";
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal', 'role' => 'form'], 'fieldConfig' => ['template' => $fieldTemplate]]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'style' => 'width:40%'])->label('分类名称:') ?>

    <div class="form-group field-category-parent_id required">
        <div class="col-sm-1"><label class="control-label" for="category-parent_id">所属父类:</label></div>
        <div class="col-sm-4">
            <select id="category-parent_id" class="form-control" name="Category[parent_id]" style="width:100%">
                <option value="0">请选择</option>
            </select>
        </div>
        <div class="col-sm-4">
            <select id="category-parent_id" class="form-control" name="Category[parent_id]" style="width:100%">
                <option value="0">请选择</option>
            </select>
        </div>
        <div class="col-sm-3">
            <div class="help-block"></div>
        </div>
    </div>

    <?= $form->field($model, 'sort')->textInput(['style' => 'width:10%', 'value' => 0])->label('排序:') ?>

    <?= $form->field($model, 'visibility')->radioList(['显示', '不显示'])->label('首页显示:') ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true, 'style' => 'width:40%', 'placeholder' => '多个关键字之间用逗号隔开'])->label('关键字:') ?>

    <?= $form->field($model, 'descript')->textarea(['rows' => 6, 'cols' => 10])->label('描述:') ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'style' => 'width:40%'])->label('SEO标题:') ?>

    <div class="form-group" style="margin-top: 10px">
        <div class="col-sm-1"></div>
        <div class="col-sm-8">
            <?= Html::submitButton($model->isNewRecord ? '确定添加' : '确定更新', ['id' => 'submit-goods','class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php $this->beginBlock('jquery') ?>

    $(function(){

        //自动填充
        $("#category-name").blur(function(){
            var val = $(this).val();
            $("#category-descript").val(val);
            $("#category-title").val(val);
        });

        var categories = (function () {
            var cats = null;
            $.ajax({
                url : '<?= Yii::$app->urlManager->createUrl(['/category/ajax-get-category-map'])?>',
                dataType : 'JSON',
                async : false,
                data : {},
                success : function (data) {
                    cats = data.data || {};
                }
            });
            return cats;
        })();

        (function(){
            var first_categories = categories[0] || {};
            var html = '';
            for(var i in first_categories) {
                html += '<option value="'+first_categories[i].id+'">'+ first_categories[i].name +'</option>';
            }
            $(".field-category-parent_id select:eq(0)").append(html);
        })();

        //第一类别选择
        $(".field-category-parent_id select:eq(0)").change(function(){
            var val = $(this).val();
            $(".field-category-parent_id select:eq(1)").show();
            var second_categories = categories[val] || {};
            var html = '<option value="'+val+'">请选择</option>';
            for(var j in second_categories) {
                html += '<option value="'+second_categories[j].id+'">'+ second_categories[j].name +'</option>';
            }
            $(".field-category-parent_id select:eq(1)").empty().append(html);
        });

    })
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['jquery'], \yii\web\View::POS_END); ?>
