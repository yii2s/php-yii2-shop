/**
 * Created by wuzhc on 2016/9/26.
 */

(function($){
    $.fn.photomatic = function(options)
    {
        var settings = $.extend({
            photoElement : '#photoDisplay', //大图显示器
            transformer : function (name) {
                return name.replace(/thumbnail/, 'photo');
            },
        }, options || {});

        //保存缩列图列表
        settings.thumbnails$ = this.filter('img');

        //缩列图添加索引和点击监听
        settings.thumbnails$
            .each(function(n){
                $(this).data('photomatic-index', n);
            })
            .click(function(){
                $(this).css({"border" : "2px solid coral"})
                    .siblings().css({"border":""});
                showPhoto($(this).data('photomatic-index'))
            });

        //显示大图
        function showPhoto(index) {
            $(settings.photoElement)
                .attr('src', settings.transformer(settings.thumbnails$[index].src));
        }
    }
})(jQuery);
