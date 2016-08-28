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
});