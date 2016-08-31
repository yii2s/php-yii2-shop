<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\module\goods\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '商品分类';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <div class="box box-primary">
        <div class="box-header">
            <form class="form-inline">
                <div class="form-group">
                    <input type="text" class="form-control" name="search-id" placeholder="搜索ID">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="search-name" placeholder="搜索名称">
                </div>
                <button type="button" class="btn btn-primary search">搜索</button>
                <?= Html::a('新建分类', ['create'], ['class' => 'btn btn-success pull-right']) ?>
            </form>
        </div>

        <div class="box-body no-padding">
            <table class="table table-bordered table-hover" style="table-layout:fixed">
                <thead>
                    <tr>
                        <th width="3%"><a href="#">分级</a></th>
                        <th width="10%"><a href="#">名称</a></th>
                        <th width="5%"><a href="#">ID</a></th>
                        <th class="action-column" width="20%">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                <?php if ($categories) { ?>
                    <?php foreach ($categories as $key => $category) { ?>
                        <?php
                            if ($category['level'] == 0) {
                                $style = 'background-color:#ddd';
                            } elseif ($category['level'] == 1) {
                                $style = 'background-color:#eeeded ';
                            } else {
                                $style = 'background-color:#f8f7f7';
                            }
                        ?>
                         <tr data-id="<?= $category['id'] ?>" data-parent="<?= $category['parentID']?>" <?= $category['level'] > 0 ? 'class="hide"' : ''?>>
                             <td class="select-tree" style="cursor:pointer;color:#000;<?= $style?>"><?php for($i=0; $i<=$category['level']; $i++) {echo '☆';}?></td>
                             <td class="enable-edit" style="<?= $category['level']==0?'font-weight:bolder':''?>" >
                                 <?= $category['name'] ?>
                             </td>
                             <td><?= $category['id']; ?></td>
                             <td>
                                 <a style="margin-right: 10px" href="<?= Yii::$app->urlManager->createUrl(['/goods/category/view', 'id' => $category['id']]);?>" title="View" aria-label="View"><span class="glyphicon glyphicon-eye-open"></span></a>
                                 <a style="margin-right: 10px" href="<?= Yii::$app->urlManager->createUrl(['/goods/category/update', 'id' => $category['id']]);?>" title="Update" aria-label="Update"><span class="glyphicon glyphicon-pencil"></span></a>
                                 <a style="margin-right: 10px" href="<?= Yii::$app->urlManager->createUrl(['/goods/category/delete', 'id' => $category['id']]);?>" title="Delete" aria-label="Delete" data-confirm="确定删除?"><span class="glyphicon glyphicon-trash"></span></a>
                             </td>
                    <?php } ?>
                <?php } else { ?>
                    <div style="text-align: center;width: 100%;margin-top: 50px;"><h1>暂无数据</h1></div>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php $this->beginBlock('jquery') ?>

    $(function(){

        //树形
        $("table tbody tr .select-tree").click(function(){
            var id = $(this).parents("tr").data("id");
            tree(id);
        });

        function tree(id)
        {
            $("table tbody tr").each(function(){
                if ($(this).data("parent") == id) {
                    if ($(this).hasClass("hide")) {
                        $(this).removeClass("hide");
                    } else {
                        $(this).addClass("hide");
                    }
                }
                return true;
            });
        }

        //可编辑表格
        $("table tbody tr .enable-edit").dblclick(function(){
            var td = $(this);
            var text = $.trim(td.text());
            var txt = $("<input type='text' class='form-control'>").val(text);
            txt.blur(function(){
                var newText = $(this).val();
                var catID = td.parents("tr").data("id");
                $.ajax({
                    url : "<?= Yii::$app->urlManager->createUrl(['/goods/category/edit-name'])?>",
                    type : "GET",
                    data : {name : newText, catID : catID},
                    success : function () {}
                });

                // 移除文本框,显示新值
                $(this).remove();
                td.text(newText);
            });
            td.text("");
            td.append(txt);
        });

        //点击搜索事件
        $(".search").click(function(){
            search();
        });

        //回车事件监听
        $(document).keypress(function(event){
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if(keycode == '13'){
                search();
            }
        });

        //搜索
        function search()
        {
            var searchID = $("input[name='search-id'][type='text']").val();
            var searchName = $("input[name='search-name'][type='text']").val();

            $("table tbody tr").each(function(){
                var thisTD = $(this).children("td");
                var isExistID = searchID ? thisTD.eq(2).text() == searchID  : true;
                var isExistName = searchName ? thisTD.eq(1).text().indexOf(searchName) > -1 : true;

                isExistID && isExistName ? $(this).removeClass("hide") : $(this).addClass("hide");
            });
        }

    })
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['jquery'], \yii\web\View::POS_END); ?>