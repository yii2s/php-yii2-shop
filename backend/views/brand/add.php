<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 产品管理 <span class="c-gray en">&gt;</span> 品牌管理 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
  <div class="text-c">
    <?php $form = ActiveForm::begin([
        'id'      => 'myform',
        'options' => ['enctype' => 'multipart/form-data'],
        'action'  => Yii::$app->urlManager->createUrl(['brand/add']),
    ]) ?>
      <div class="bk-gray bg-1" style="float: left;color: red;font-size: 16px;font-weight: bold">请选择品牌所属类别:</div>
      <div class="fl pd-5 bg-3" style="float: left;text-align: left;">
        <?= $form->field($model, 'categoryIDs[]')->checkboxList($categoryLists)->label(false);?>
      </div>
      <div>
        <?= $form->field($model, 'title')->label(false)->textInput(['style'=>'width:160px','class'=>'input-text','placeholder'=>"分类名称"])?>
        <?= $form->field($model, 'logo')->label(false)->fileInput(['class'=>'input-text','style'=>'color:red']) ?>
        <?= $form->field($model, 'flag')->dropDownList(['0'=>'国内品牌','1'=>'国外品牌'], ['style'=>'width:120px','class'=>'select-box'])->label(false) ?>
        <?= $form->field($model, 'intro')->textarea(['rows'=>3,'cols'=>150])->label(false)?>
        <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>
      </div>
    <!--</form>-->
    <?php ActiveForm::end() ?>
  </div>
  <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a></span><span class="r">共有数据：<strong>54</strong> 条</span> </div>
  <div class="mt-20">
    <table class="table table-border table-bordered table-bg table-sort">
      <thead>
      <tr class="text-c">
        <th width="25"><input type="checkbox" name="" value=""></th>
        <th width="70">ID</th>
        <th width="80">排序</th>
        <th width="200">LOGO</th>
        <th width="120">品牌名称</th>
        <th>具体描述</th>
        <th width="100">操作</th>
      </tr>
      </thead>
      <tbody>
      <?php if (is_array($brandLists)): ?>
          <?php foreach ($brandLists as $item): ?>
      <tr class="text-c">
        <td><input name="" type="checkbox" value="<?= $item->id ?>"></td>
        <td><?= $item->id ?></td>
        <td><input type="text" class="input-text text-c" value="<?= $item->id ?>"></td>
        <td><img src="./uploads/<?= $item->logo ?>" width="150px" height="50px" ></td>
        <td class="text-l"><?= $item->title ?></td>
        <td class="text-l"><?= $item->intro ?: '无' ?></td>
        <td class="f-14 product-brand-manage">
          <a style="text-decoration:none" onClick="product_brand_edit('品牌编辑','codeing.html','1')" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>
          <a style="text-decoration:none" class="ml-5" href="<?= Yii::$app->urlManager->createUrl(['brand/delete','id'=>$item->id])?>" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
      </tr>
          <?php endforeach; ?>
      <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
<?= Html::jsFile('public/backend/lib/jquery/1.9.1/jquery.min.js')?>
<?= Html::jsFile('public/backend/lib/layer/1.9.3/layer.js')?>
<?= Html::jsFile('public/backend/lib/laypage/1.2/laypage.js')?>
<?= Html::jsFile('public/backend/lib/My97DatePicker/WdatePicker.js')?>
<?= Html::jsFile('public/backend/lib/datatables/1.10.0/jquery.dataTables.min.js')?>
<?= Html::jsFile('public/backend/js/H-ui.js')?>
<?= Html::jsFile('public/backend/js/H-ui.admin.js')?>
<?/*= Html::jsFile('public/backend/js/H-ui.admin.product.js')*/?>
<script type="text/javascript">
  $('.table-sort').dataTable({
    "aaSorting": [[ 1, "desc" ]],//默认第几个排序
    "bStateSave": true,//状态保存
    "aoColumnDefs": [
      //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
      {"orderable":false,"aTargets":[0,6]}// 制定列不参与排序
    ]
  });

  function addBrand($this) {
    var data = $("#myform").serialize();
    $.post('<?= Yii::$app->urlManager->createUrl(['brand/add']) ?>',data,function(data){
      //alert(data);
    });
  }
</script>
