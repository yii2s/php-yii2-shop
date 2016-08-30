<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $form yii\widgets\ActiveForm */

$fieldTemplate = "{label}<div class=\"col-sm-6\">{input}</div><div class=\"col-sm-4\">{hint}{error}</div>";
?>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Horizontal Form</h3>
    </div>

    <?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal', 'role' => 'form'], 'fieldConfig' => ['template' => $fieldTemplate]]); ?>

    <div class="box-body">

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'style' => 'width:40%'])->label('分类名称:',['class' => 'col-sm-2 control-label']) ?>

    <div class="form-group field-category-parent_id required">
        <label class="control-label col-sm-2" for="category-parent_id">所属父类:</label>
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

    <?= $form->field($model, 'sort')->textInput(['style' => 'width:10%', 'value' => 0])->label('排序:',['class' => 'col-sm-2 control-label']) ?>

    <?= $form->field($model, 'visibility')->radioList(['显示', '不显示'])->label('首页显示:',['class' => 'col-sm-2 control-label']) ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true, 'style' => 'width:40%', 'placeholder' => '多个关键字之间用逗号隔开'])->label('关键字:',['class' => 'col-sm-2 control-label']) ?>

    <?= $form->field($model, 'descript')->textarea(['rows' => 6, 'cols' => 10])->label('描述:',['class' => 'col-sm-2 control-label']) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'style' => 'width:40%'])->label('SEO标题:',['class' => 'col-sm-2 control-label']) ?>

    </div>
    <div class="box-footer">
            <?= Html::submitButton($model->isNewRecord ? '确定添加' : '确定更新', ['id' => 'submit-goods','class' => $model->isNewRecord ? 'btn btn-success pull-right' : 'btn btn-primary pull-right']) ?>
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
