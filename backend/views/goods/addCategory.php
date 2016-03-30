<?php
use yii\helpers\Html;
?>
<?php $this->registerCssFile('public/backend/lib/icheck/icheck.css',['position'=>\yii\web\View::POS_HEAD])?>
<div class="pd-20">
  <form action="" method="post" class="form form-horizontal" id="form-user-add">
    <div class="row cl">
      <label class="form-label col-2"><span class="c-red">*</span>分类名称：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="" placeholder="" id="user-name" name="product-category-name">
      </div>
      <div class="col-5"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-2">备注：</label>
      <div class="formControls col-5">
        <textarea name="" cols="" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符" datatype="*10-100" dragonfly="true" nullmsg="备注不能为空！" onKeyUp="textarealength(this,100)"></textarea>
        <p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p>
      </div>
      <div class="col-5"> </div>
    </div>
    <div class="row cl">
      <div class="col-9 col-offset-2">
        <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
      </div>
    </div>
  </form>
</div>
</div>
<?= Html::jsFile('public/backend/lib/jquery/1.9.1/jquery.min.js')?>
<?= Html::jsFile('public/backend/lib/icheck/jquery.icheck.min.js')?>
<?= Html::jsFile('public/backend/lib/Validform/5.3.2/Validform.min.js')?>
<?= Html::jsFile('public/backend/lib/layer/1.9.3/layer.js')?>
<?= Html::jsFile('public/backend/js/H-ui.js')?>
<?= Html::jsFile('public/backend/js/H-ui.admin.js')?>
<script type="text/javascript">
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	
	$("#form-user-add").Validform({
		tiptype:2,
		callback:function(form){
			form[0].submit();
			var index = parent.layer.getFrameIndex(window.name);
			parent.$('.btn-refresh').click();
			parent.layer.close(index);
		}
	});
});
</script>
