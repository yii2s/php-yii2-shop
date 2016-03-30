<?php
use yii\helpers\Html;
?>
<?php $this->registerCssFile('public/backend/lib/zTree/v3/css/zTreeStyle/zTreeStyle.css',['position'=>\yii\web\View::POS_HEAD]) ?>
<?php $this->registerCssFile('public/backend/lib/icheck/icheck.css',['position'=>\yii\web\View::POS_HEAD])?>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 产品管理 <span class="c-gray en">&gt;</span> 产品分类 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<table class="table">
	<tr>
		<td width="250" class="va-t">

		</td>
		<td class="va-t">
			<!--<IFRAME ID="testIframe" Name="testIframe" FRAMEBORDER=0 SCROLLING=AUTO width=100%  height=390px SRC="<?/*= Yii::$app->urlManager->createUrl(['categories/add'])*/?>"></IFRAME>-->
			<div class="pd-20">
				<form action="" method="post" class="form form-horizontal" id="form-user-add">
					<div class="row cl">
						<label class="form-label col-2"><span class="c-red">*</span>所属类别：</label>
						<div class="formControls col-5">
							<ul class="list">
								<li class="title"><input id="citySel" type="text" readonly value="" style="width:200px;" class="input-text"/>
									&nbsp;<a id="menuBtn" href="#" onclick="showMenu(); return false;">选择</a></li>
							</ul>
						</div>
						<div id="menuContent" class="menuContent" style="display:none; position: absolute;z-index:10;background-color:#FFFFFF;width: 400px">
							<ul id="treeDemo" class="ztree" style="margin-top:0; width:160px;"></ul>
						</div>
					</div>
					<div class="row cl" style="z-index:-1">
						<label class="form-label col-2"><span class="c-red">*</span>分类名称：</label>
						<div class="formControls col-5">
							<input type="text" class="input-text" value="" placeholder="" id="user-name" name="product-category-name">
						</div>
						<div class="col-5"> </div>
					</div>
					<div class="row cl" style="z-index:-1">
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
		</td>
	</tr>
</table>
<?= Html::jsFile('public/backend/lib/jquery/1.9.1/jquery.min.js')?>
<?= Html::jsFile('public/backend/lib/layer/1.9.3/layer.js')?>
<?= Html::jsFile('public/backend/lib/Validform/5.3.2/Validform.min.js')?>
<?= Html::jsFile('public/backend/lib/zTree/v3/js/jquery.ztree.core-3.5.js')?>
<?= Html::jsFile('public/backend/js/H-ui.js')?>
<?= Html::jsFile('public/backend/js/H-ui.admin.js')?>



<SCRIPT type="text/javascript">
	<!--
	var setting = {
		view: {
			dblClickExpand: false
		},
		data: {
			simpleData: {
				enable: true
			}
		},
		callback: {
			beforeClick: beforeClick,
			onClick: onClick
		}
	};

	var zNodes =[
		{id:4, pId:0, name:"河北省", open:true},
		{id:41, pId:4, name:"石家庄"},
		{id:42, pId:4, name:"保定"},
		{id:43, pId:4, name:"邯郸"},
		{id:44, pId:4, name:"承德"},
		{id:4, pId:0, name:"河北省", open:true},
		{id:41, pId:4, name:"石家庄"},
		{id:42, pId:4, name:"保定"},
		{id:43, pId:4, name:"邯郸"},
		{id:44, pId:4, name:"承德"},
		{id:4, pId:0, name:"河北省", open:true},
		{id:41, pId:4, name:"石家庄"},
		{id:42, pId:4, name:"保定"},
		{id:43, pId:4, name:"邯郸"},
		{id:44, pId:4, name:"承德"},
		{id:4, pId:0, name:"河北省", open:true},
		{id:41, pId:4, name:"石家庄"},
		{id:42, pId:4, name:"保定"},
		{id:43, pId:4, name:"邯郸"},
		{id:44, pId:4, name:"承德"},
		{id:4, pId:0, name:"河北省", open:true},
		{id:41, pId:4, name:"石家庄"},
		{id:42, pId:4, name:"保定"},
		{id:43, pId:4, name:"邯郸"},
		{id:44, pId:4, name:"承德"},
		{id:4, pId:0, name:"河北省", open:true},
		{id:41, pId:4, name:"石家庄"},
		{id:42, pId:4, name:"保定"},
		{id:43, pId:4, name:"邯郸"},
		{id:44, pId:4, name:"承德"},
		{id:4, pId:0, name:"河北省", open:true},
		{id:41, pId:4, name:"石家庄"},
		{id:42, pId:4, name:"保定"},
		{id:43, pId:4, name:"邯郸"},
		{id:44, pId:4, name:"承德"},
		{id:4, pId:0, name:"河北省", open:true},
		{id:41, pId:4, name:"石家庄"},
		{id:42, pId:4, name:"保定"},
		{id:43, pId:4, name:"邯郸"},
		{id:44, pId:4, name:"承德"},

		{id:1, pId:0, name:"北京"},
		{id:2, pId:0, name:"天津"},
		{id:3, pId:0, name:"上海"},
		{id:6, pId:0, name:"重庆重庆重庆重庆重庆重庆"},
		{id:4, pId:0, name:"河北省", open:true},
		{id:41, pId:4, name:"石家庄"},
		{id:42, pId:4, name:"保定"},
		{id:43, pId:4, name:"邯郸"},
		{id:44, pId:4, name:"承德"},
		{id:5, pId:0, name:"广东省", open:true},
		{id:51, pId:5, name:"广州"},
		{id:52, pId:5, name:"深圳"},
		{id:53, pId:5, name:"东莞"},
		{id:54, pId:5, name:"佛山"},
		{id:6, pId:0, name:"福建省", open:true},
		{id:61, pId:6, name:"福州"},
		{id:62, pId:6, name:"厦门"},
		{id:63, pId:6, name:"泉州"},
		{id:64, pId:6, name:"三明"}
	];

	function beforeClick(treeId, treeNode) {
		var check = (treeNode && !treeNode.isParent);
		if (!check) alert("只能选择城市...");
		return check;
	}

	function onClick(e, treeId, treeNode) {
		var zTree = $.fn.zTree.getZTreeObj("treeDemo"),
			nodes = zTree.getSelectedNodes(),
			v = "";
		nodes.sort(function compare(a,b){return a.id-b.id;});
		for (var i=0, l=nodes.length; i<l; i++) {
			v += nodes[i].name + ",";
		}
		if (v.length > 0 ) v = v.substring(0, v.length-1);
		var cityObj = $("#citySel");
		cityObj.attr("value", v);
		hideMenu();
	}

	function showMenu() {
		var cityObj = $("#citySel");
		var cityOffset = $("#citySel").offset();
		$("#menuContent").css({left:cityOffset.left + "px", top:cityOffset.top + cityObj.outerHeight() + "px"}).slideDown("fast");

		$("body").bind("mousedown", onBodyDown);
	}
	function hideMenu() {
		$("#menuContent").fadeOut("fast");
		$("body").unbind("mousedown", onBodyDown);
	}
	function onBodyDown(event) {
		if (!(event.target.id == "menuBtn" || event.target.id == "menuContent" || $(event.target).parents("#menuContent").length>0)) {
			hideMenu();
		}
	}

	$(document).ready(function(){
		$.fn.zTree.init($("#treeDemo"), setting, zNodes);
	});
	//-->
</SCRIPT>

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