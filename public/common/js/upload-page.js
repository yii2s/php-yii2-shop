/**
 * [分页]
 * @param {[Object]} options [设置]
 * options： {
 *     pageNum: 显示的分页页数默认10页，
 *     len：每页的记录条数默认10条，
 *     $el: 分页的外层容器，
 *     callback: 回调函数，
 *     params: 回调函数中所需要的参数，
 *             params在经过此插件后会添加start,len这两个属性,
 *             start是记录开始下标（回调函数中可以自己处理成页码）， 每页的记录条数
 *     total: 总记录数， 可选
 * }
 */
function UpLoadPage(options) {
    var $container = '<nav><ul class="pagination pagination-lg"></ul></nav>',
        $prev = '<li class="page-prev"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>',
        $next = '<li class="page-next"><a href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>',
        $infos = '<li class="page-info"></li>';

    var cur = 0, max = 0,
        len = options.len || 10,
        pageNum = options.pageNum || 10,
        total = options.total || 0,
        params = options.params || {},
        callback = options.callback,
        $el = options.$el;

    function getEventTag(e) {
        e = e || window.event;
        return e.target || e.srcElement;
    }

    function pageShow($pgs, $self) {
        var i = $self.attr("data-i");
        var start = i * len;
        cur = i;
        params.start = start;
        params.len = len;
        params.first = false;
        callback(params);
        $pgs.hide();
    }

    this.setPage = function(total) {
        var time = (new Date()).getTime();
        var uls = "", istart, iend;
        max = Math.ceil(total / len);
        if (max > 1) {
            cur = cur < 0 ? 0 : cur > max - 1 ? max - 1 : cur;
            var c1 = Math.ceil(pageNum / 2), c2 = Math.ceil((pageNum + 1) / 2);
            if (cur >= c1 && cur < max - c2) {
                istart = cur - c1 + 1;
                iend = cur - c1 + pageNum;
            } else if (cur < c1) {
                istart = 0;
                iend = pageNum - 1;
            } else if (cur >= max - c2) {
                istart = max - pageNum;
                iend = max - 1;
            }
            istart = istart < 0 ? 0 : istart;
            iend = iend >= max ? max - 1 : iend;
            $el.html("").append($container);
            var $ec = $el.find(".pagination");
            $ec.append($prev);
            for (var i = istart; i <= iend; i++) {
                $ec.append('<li class="page '+(i == cur ? 'active' : '')+'" data-i="' + i + '"><a class="" href="JavaScript:void(0)">' + (i + 1) + '</a></li>');
            }
            $ec.append($next);
            $ec.append($infos);
            $el.find(".page-prev").removeClass("disabled");
            $el.find(".page-next").removeClass("disabled");
            if (cur == 0) {
                $el.find(".page-prev").addClass("disabled");
            } else if (cur >= max - 1) {
                $el.find(".page-next").addClass("disabled");
            }
           /* $el.find(".page-info").text("共有" + total + "条记录");*/
        }
    }

    this.init = function() {
        params.start = 0;
        params.len = len;
        params.first = true;
        params.page = this;
        $el.html("");
        callback(params);
        if (total) {
            this.setPage(total);
        }

        $el.off();
        $el.click(function(e) {
            /*document.getElementById('goods-list').scrollIntoView();*/
            scroll(0,0); //回到顶部
            var srcE = getEventTag(e);
            var $p = $(srcE).parent();
            var $self = null;
            if ($p.hasClass("page") && !$(srcE).hasClass("active")) {
                $self = $p;
            } else if($p.hasClass("disabled")) {
                return false;
            } else if ($p.hasClass("page-prev")) {
                $self = $el.find("li.active").parent(".page").prev(".page");
            } else if ($p.hasClass("page-next")) {
                $self = $el.find("li.active").parent(".page").next(".page");
            } else {
                return false;
            }
            var $ec = $el.find(".pagination");
            pageShow($ec, $self);
        })
    }
}