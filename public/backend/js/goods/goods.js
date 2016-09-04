/**
 * Created by wuzhc on 2016/8/26.
 */


$(function(){
    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').focus()
    })

    $('#submit-goods').on('click', function () {
        var $btn = $(this).button('loading');
        // business logic...
        $btn.button('reset')
    })

    $("input[name='Goods[name]']").blur(function(){

    });

    $("input[name='spec-select']:checked").each(function () {

    });

    $("#add-spec").click(function () {
        $('#specModal').modal('hide')
    });

    $("#show-spec").click(function() {
        $('#specModal').modal('show')
    });

    //新增规格
    var addSpecAjaxAbort = null;
    $("#submit-spec").click(function() {

        addSpecAjaxAbort && addSpecAjaxAbort.abort();

        var specText = $("#spec_text").val();
        var type = $("input[name='type']:checked").val();
        var name = $("input[name='spec_name']").val();

        var specImg = [];
        $("input[name='spec_img']").each(function() {
            specImg.push($(this).val());
        });

        var data = {
            type : type,
            name : name,
            value : type == 1 ? specText : specImg
        };

        addSpecAjaxAbort = $.ajax({
            type : 'post',
            url : "./admin.php?r=goods/default/add-spec",
            data : data,
            dataType : "json",
            success : function (data) {
                if (data.status == 0) {
                    $(".spec_group").prepend(data.data);
                    $("#specModal").modal('show');
                    $("#myModal").modal('hide');
                } else {
                    alert("添加失败");
                }
            }
        });
    });

    //搜索规格
    $("#search-spec").click(function() {
        var keyword = $("input[name='search-spec']").val();
        $(".spec_group").find(".spec_name").each(function() {
            if ($(this).text().indexOf(keyword) > -1) {
                $(this).parent().parent().show();
            } else {
                $(this).parent().parent().hide();
            }
        });
    });

    //规格类型切换
    $(".spec-type").click(function() {
        var type = $(this).val();
        if (type == 1) {
            $(".spec-text").removeClass("hide");
            $(".spec-img").addClass("hide");
            $("input[name='spec_img']").val("");
        } else {
            $(".spec-text").addClass("hide");
            $(".spec-img").removeClass("hide");
            $("input[name='spec_text']").val("");
        }
    });

    //提交规格值
    $(".submit-spec-val").click(function() {
        var spec = [], spec_val = [];
        $(".spec_one").each(function() {
            var temp = [];
            $(this).children(".checkbox-inline").each(function() {
                var val = $(this).children("input[type='checkbox']:checked").val();
                if (val) {
                    temp.push(val);
                }
            });
            if (temp.length > 0) {
                var data = {};
                data['children'] = temp;
                data['name'] = $(this).prev().children("h3").text();
                spec.push(data);
                spec_val.push(temp);
            }
        });
        //console.log(JSON.stringify(spec));
        //console.log(spec_val);


        recurToData(spec_val);
        var list = spec_val[0];
        //console.log(data);
        var html = '<table class="table"><th>产品</th><th>商品编号</th><th>库存</th><th>市场价格</th><th>销售价格</th>';
        for (var i in list) {
            html += '<tr>';
            html += '<td>'+ replaceImg(list[i]) +'<input type="hidden" name="Goods[spec]['+i+'][spec_array]" value="'+ list[i] +'"></td>';
            html += '<td><input type="text" name="Goods[spec]['+i+'][products_no]" value="K987" size="7"></td>';
            html += '<td><input type="text" name="Goods[spec]['+i+'][store_nums]" size="7" value="10000"></td>';
            html += '<td><input type="text" name="Goods[spec]['+i+'][market_price]" size="7" value="300"></td>';
            html += '<td><input type="text" name="Goods[spec]['+i+'][sell_price]" size="7" value="298"></td>';
            html += '</tr>';
        }
        html += '</table>';
        html += '<input type="hidden" name="Goods[spec_array]" value='+ JSON.stringify(spec) +'>';
        $(".spec-zhuhe").empty().html(html);
        $(".spec-zhuhe").parent().removeClass("hide");

        $('#specModal').modal('hide');
    });

    //递归组合规格
    function recurToData(val)
    {
        var temp = [];

        if (val.length == 1) {
            return val;
        }

        for (var i in val[0]) {
            for (var j in val[1]) {
                temp.push(val[0][i] + '，' + val[1][j]);
            }
        }
        val.splice(0, 2, temp);
        return recurToData(val);
    }

    //生成图片
    function replaceImg (str)
    {
        var arr = str.split("，") || [];
        for (var i in arr) {
            if (arr[i].indexOf("uploads") === 0) {
                arr[i] = '<img src="'+ arr[i] +'"/>'
            }
        }

        return arr.join("，");
    }

    var categories = (function () {
        var cats = null;
        $.ajax({
            url : './admin.php?r=category/ajax-get-category-map',
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
        $(".field-category-parent_id select:eq(1)").removeClass("hide");
        $(".field-category-parent_id select:eq(2)").empty().addClass("hide");
        $("#attr-select").empty().parent().addClass("hide");
        $("#cid").val(val);
        var second_categories = categories[val] || {};
        var html = '<option>--请选择--</option>';
        for(var j in second_categories) {
            html += '<option value="'+second_categories[j].id+'">'+ second_categories[j].name +'</option>';
        }
        $(".field-category-parent_id select:eq(1)").empty().append(html);
    });

    //第二类别选择
    $(".field-category-parent_id select:eq(1)").change(function(){
        var val = $(this).val();
        $(".field-category-parent_id select:eq(2)").empty();
        $("#attr-select").empty();
        $("#cid").val(val);
        var three_categories = categories[val] || {};
        var html = '<option>--请选择--</option>';
        for(var j in three_categories) {
            html += '<option value="'+three_categories[j].id+'">'+ three_categories[j].name +'</option>';
        }
        $(".field-category-parent_id select:eq(2)").removeClass("hide").append(html);
    });

    //属性查找
    $(".field-category-parent_id select:eq(2)").change(function(){
        $("#attr-select").empty();
        var categoryID = $(this).val();
        $("#cid").val(categoryID);
        $.ajax({
            type : "GET",
            url : './admin.php?r=category/get-attr-val-by-cid',
            data : {cid : categoryID},
            dataType : 'json',
            success : function(data) {
                var attr = data.data || {};
                if (attr) {
                    var html = '';

                    for (var k in attr) {
                        html += '<div class="panel panel-default" style="width: 98%">';
                        html += '<div class="panel-heading">';
                        html += '<h3 class="panel-title">'+attr[k].name+'</h3>';
                        html += '</div><div class="panel-body">';
                        var val = attr[k].value || {};
                        for (var v in val) {
                            html += '<label class="checkbox-inline">';
                            html += '<input type="checkbox" name="Goods[sys_attr][]" value='+attr[k].id+'-'+val[v].id+'>' + val[v].name;
                            html += '</label>';
                        }
                        html += '</div></div>';
                    }

                    $("#attr-select").html(html);
                    $("#attr-select").parent().removeClass("hide");
                }
            }
        });
    });

    //添加扩展属性
    $("#add-ext-attr").click(function() {
        $(this).next().removeClass("hide");
        var index = $(".ext-attr").size();

        var html = '<tr class="ext-attr">';
        html += '<td><input type="text" class="form-control" name="Goods[ext_Attr]['+index+'][name]" value=""></td>';
        html += '<td><input type="text" class="form-control" name="Goods[ext_Attr]['+index+'][value]" value=""></td>';
        html += '</tr>';
        $(this).next().find(".table").append(html);
    });

});