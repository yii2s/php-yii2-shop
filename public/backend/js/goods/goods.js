/**
 * Created by wuzhc on 2016/8/26.
 */


$(function(){
    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').focus()
    })

    $('#submit-goods').on('click', function () {
        alert("haha");
        var $btn = $(this).button('loading');
        // business logic...
        $btn.button('reset')
    })

    $("input[name='Goods[name]']").blur(function(){
        alert("hall");
    });

    $("input[name='spec-select']:checked").each(function () {

    });

    $("#add-spec").click(function () {
        $('#specModal').modal('hide')
    });

    $("#show-spec").click(function() {
        $('#specModal').modal('show')
    });

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
});