//图片列表展示效果 - 本效果由昆明天度网络IRIS原创制作
function imgSlideShow(_obj) {
    var _box = $(_obj.showbox);
    var _sum = $(_obj.showsum);
    var _arr = _sum.find(_obj.showpart);
    var _length = _arr.length;
    var _menu = $(_obj.menuid);
    var _index = 0;
    var _mindex = 0;

    _box.css({ "overflow": "hidden", "width": _obj.showw + "px", "height": _obj.showh + "px", "position": "relative" });
    _arr.css({ "width": _obj.showw + "px", "height": _obj.showh + "px", "float": "left" });
    var _sumwidth = _length * _obj.showw;
    _sum.css({ "width": _sumwidth + "px", "position": "relative", "left": "0px" });

    _menu.append("<ul></ul>");
    var _menusum = _menu.find("ul");
    for (var i = 0; i < _length; i++) {
        var _mstr = "<li></li>";
        _menusum.append(_mstr);
        _menu.find("li").eq(i).append(_arr.eq(i).find(_obj.showimg).clone());
    }
    var _marr = _menusum.find("li");
    _marr.eq(_index).addClass(_obj.menusel);
    _menusum.css({ "position": "relative", "left": "0px", "width": _sumwidth + "px" });
    var _menuwidth = _obj.menumove * _obj.menunum;
    _menu.css({ "overflow": "hidden", "width": _menuwidth + "px" });
    _marr.css({ "float": "left", "position": "relative" });


    //下一页
    var _nextpage = function () {
        _index++;
        if (_index >= _length) { _index = _length - 1; }
        var _imgmove = -_index * _obj.showw;
        if (_sum.is(":animated")) { _sum.stop(true, true); }
        _sum.animate({ left: _imgmove + "px" }, 300);
        _marr.eq(_index).addClass(_obj.menusel).siblings().removeClass(_obj.menusel);

        var _jx = _mindex + _obj.menunum;
        if (_index == _jx) {
            _mindex++;
            var _menumove = -_mindex * _obj.menumove;
            if (_menusum.is(":animated")) { _menusum.stop(true, true); }
            _menusum.animate({ left: _menumove + "px" }, 300);
        }

    };//fun END

    //上一页
    var _lastpage = function () {
        _index--;
        if (_index < 0) { _index = 0; }
        var _imgmove = -_index * _obj.showw;
        if (_sum.is(":animated")) { _sum.stop(true, true); }
        _sum.animate({ left: _imgmove + "px" }, 300);
        _marr.eq(_index).addClass(_obj.menusel).siblings().removeClass(_obj.menusel);

        var _jx = _mindex;
        if (_index + 1 == _jx && _jx > 0) {
            _mindex--;
            var _menumove = -_mindex * _obj.menumove;
            if (_menusum.is(":animated")) { _menusum.stop(true, true); }
            _menusum.animate({ left: _menumove + "px" }, 300);
        }

    };//fun END

    $(_obj.nextid).click(function () { _nextpage(); });
    $(_obj.lastid).click(function () { _lastpage(); });
    $(_obj.menunext).click(function () { _nextpage(); });
    $(_obj.menulast).click(function () { _lastpage(); });

    _marr.hover(function () {
        _index = $(this).index();
        var _imgmove = -_index * _obj.showw;
        if (_sum.is(":animated")) { _sum.stop(true, true); }
        _sum.animate({ left: _imgmove + "px" }, 300);
        _marr.eq(_index).addClass(_obj.menusel).siblings().removeClass(_obj.menusel);
    });

}

//点击选项卡
function clickBoxShow(menuid, _mname, sumid, _sname, _hover) {
    var _menu = $("#" + menuid);
    var _marr = _menu.find(_mname);
    var _sum = $("#" + sumid);
    var _sarr = _sum.find(_sname);
    var _index = 0;
    _marr.eq(0).addClass(_hover);
    _sarr.eq(0).css("display", "block").siblings().css("display", "none");
    _marr.click(function () {
        _index = $(this).index();
        _marr.eq(_index).addClass(_hover).siblings().removeClass(_hover);
        _sarr.eq(_index).css("display", "block").siblings().css("display", "none");
    });
}

//多组图片Y轴轮播
function checkListShow(listid, lastid, nextid, _dire, _height, _num) {
    var _list = $("#" + listid);
    var _last = $("#" + lastid);
    var _next = $("#" + nextid);
    var _index = 0;
    var _lenght = $("#" + listid + " li").length;
    var _max = parseInt(_lenght / _num);
    var _yu = _lenght % _num;
    if (_yu == 0) {
        _max = _max - 1;
    }

    _next.click(function () {
        if (_lenght > _num && _index < _max) {
            eval('_list.animate({' + _dire + ':"-="+' + _height + '+"px"},100);');

            _index++;
        }
    });
    _last.click(function () {
        if (_lenght > _num && _index > 0) {
            eval('_list.animate({' + _dire + ':"+="+' + _height + '+"px"},100);');

            _index--;
        }
    });
}

//本网站效果由昆明天度网络IRIS原创制作
function navScrollTop(_navid, _top) {
    var _nav = $("#" + _navid);
    $(window).scroll(function () {
        var _now = $(window).scrollTop();
        if (_now >= _top) {
            _nav.css({ "position": "fixed", "top": "0" });
        } else {
            _nav.css({ "position": "absolute", "top": _top + "px" });
        }
    });
}

//Banner轮播
function bannerCartoon(_boxid, _part, _numid, _carsp, _speed, _lastid, _nextid) {
    var _box = $("#" + _boxid);
    var _arr = _box.find(_part);
    var _length = _arr.length;
    var _numbox = $("#" + _numid);
    var _index = 0;
    _arr.eq(_index).css("display", "block").siblings().css("display", "none");

    //轮播数字
    var _numstr = "<span class='numsel'>1</span>";
    for (var i = 2; i < _length + 1; i++) {
        _numstr += "<span>" + i + "</span>";
    }
    _numbox.html(_numstr);
    var _numarr = _numbox.find("span");

    var _nextgo = function () {
        _index++;
        if (_index >= _length) { _index = 0; }
        _arr.stop(true, true);
        _arr.eq(_index).fadeIn(_carsp).siblings().fadeOut(_carsp);
        _numarr.eq(_index).addClass('numsel').siblings().removeClass('numsel');
    };//END
    var _lastgo = function () {
        _index--;
        if (_index < 0) { _index = _length - 1; }
        _arr.stop(true, true);
        _arr.eq(_index).fadeIn(_carsp).siblings().fadeOut(_carsp);
        _numarr.eq(_index).addClass('numsel').siblings().removeClass('numsel');
    };//END

    var _cartoon = setInterval(_nextgo, _speed);
    _box.hover(function () {
        clearInterval(_cartoon);
    }, function () {
        _cartoon = setInterval(_nextgo, _speed);
    });
    _numarr.hover(function () {
        _index = $(this).index();
        _arr.stop(true, true);
        _arr.eq(_index).fadeIn(_carsp).siblings().fadeOut(_carsp);
        _numarr.eq(_index).addClass('numsel').siblings().removeClass('numsel');
    });
}

//通用悬停选项卡
function menuCheckShow(menuid, mname, sumid, sname, _hover, _starnum) {
    var _menu = $("#" + menuid).find(mname);
    var _arr = $("#" + sumid).find(sname);
    var _index = _starnum;
    _menu.eq(_index).addClass(_hover).siblings().removeClass(_hover);
    _arr.eq(_index).css("display", "block").siblings().css("display", "none");
    _menu.hover(function () {
        _index = $(this).index();
        _menu.eq(_index).addClass(_hover).siblings().removeClass(_hover);
        _arr.eq(_index).fadeIn(300).siblings().fadeOut(300);
    });
}
//通用悬停选项卡
function menuCheckShow(menuid, mname, sumid, sname, _hover) {
    var _menu = $("#" + menuid).find(mname);
    var _arr = $("#" + sumid).find(sname);
    var _index = 0;
    _menu.eq(_index).addClass(_hover).siblings().removeClass(_hover);
    _arr.eq(_index).css("display", "block").siblings().css("display", "none");
    _menu.hover(function () {
        _index = $(this).index();
        _menu.eq(_index).addClass(_hover).siblings().removeClass(_hover);
        _arr.eq(_index).fadeIn(300).siblings().fadeOut(300);
    });
}
//通用悬停选项卡
function menuCheckShowBast(menuid, mname, sumid, sname, _hover) {
    var _menu = $("#" + menuid).find(mname);
    var _arr = $("#" + sumid).find(sname);
    var _index = 0;
    _menu.eq(_index).addClass(_hover).siblings().removeClass(_hover);
    _arr.eq(_index).css("display", "block").siblings().css("display", "none");
    _menu.hover(function () {
        _index = $(this).index();
        _menu.eq(_index).addClass(_hover).siblings().removeClass(_hover);
        _arr.eq(_index).css("display", "block").siblings().css("display", "none");
    });
}


//下拉菜单 - 本效果由昆明天度网络IRIS原创制作
function menuDownList(boxid, _showname, _name, _hover) {
    var _box = $("#" + boxid);
    var _show = _box.find(_showname);
    var _chek = _box.find(_name);
    _box.hover(function () {
        if (_show.is(":animated")) { _show.stop(true, true); }
        _chek.addClass(_hover);
        _show.fadeIn(300);
    }, function () {
        if (_show.is(":animated")) { _show.stop(true, true); }
        _chek.removeClass(_hover);
        _show.fadeOut(300);
    });
}

//登录下拉
function cityDown(obj) {
    var _box = $(obj).parent().find("menu");
    _box.slideToggle(200);
}

//城市选择
function cityCheck(obj) {
    var _str = $(obj).html();
    var _box = $(obj).parent().parent().find(".a1");
    _box.html(_str);
    $(obj).parent().slideUp(200);
}

//多组图片轮播
function leftMoveList(boxid, _num, _name, _width, nextid, lastid) {
    var _box = $(boxid);
    var _next = $(nextid);
    var _last = $(lastid);
    var _index = 0;
    var _arr = _box.find(_name);
    var _length = _arr.length;
    var _max = Math.ceil(_length / _num);
    _next.click(function () {
        _index++;

        if (_index >= _max) { _index = _max - 1; }
        if (_box.is(":animated")) { _box.stop(true, true); }
        var _move = -_index * _width;
        _box.animate({ left: _move + "px" }, 300);
    });
    _last.click(function () {
        _index--;
        if (_index < 0) { _index = 0; }
        if (_box.is(":animated")) { _box.stop(true, true); }
        var _move = -_index * _width;
        _box.animate({ left: _move + "px" }, 300);
    });
}

//顶部扫描单独下拉 - 本效果由昆明天度网络IRIS原创制作
function navDownList(boxid, _sumname, _showname) {
    var _box = $("#" + boxid);
    var _arr = _box.find(_sumname);
    var _hover = _box.find(_showname);
    _arr.hover(function () {
        if (_hover.is(":animated")) { _hover.stop(true, true); }
        var _height = $(this).height() + 5;
        $(this).find(".bg").height(_height);
        $(this).find(_showname).fadeIn(100);
    }, function () {
        if (_hover.is(":animated")) { _hover.stop(true, true); }
        _hover.fadeOut(100);
    });
}

//选项卡 - 本效果由昆明天度网络IRIS原创制作
function checkBoxShow(menuid, _mname, sumid, _sname, _hover) {
    var _menu = $("#" + menuid);
    var _marr = _menu.find(_mname);
    var _sum = $("#" + sumid);
    var _sarr = _sum.find(_sname);
    var _index = 0;
    _marr.eq(0).addClass(_hover);
    _sarr.eq(0).css("display", "block").siblings().css("display", "none");
    _marr.hover(function () {
        _index = $(this).index();
        _marr.eq(_index).addClass(_hover).siblings().removeClass(_hover);
        _sarr.eq(_index).css("display", "block").siblings().css("display", "none");
    });
}

//首页专用选项卡 - 本效果由昆明天度网络IRIS原创制作
function indexBoxShow(menuid, _mname, sumid, _sname, _hover) {
    var _menu = $("#" + menuid);
    var _marr = _menu.find(_mname);
    var _sum = $("#" + sumid);
    var _sarr = _sum.find(_sname);
    var _index = _marr.length - 1;
    _marr.last().addClass(_hover);
    _marr.last().css("border-left", "1px solid #e9e9e9");
    _marr.eq(0).css("border-right", "1px solid #e9e9e9");
    _marr.eq(0).find("span").css("border", "none");
    _sarr.last().css("display", "block").siblings().css("display", "none");
    _marr.hover(function () {
        _index = $(this).index();
        _marr.eq(_index).addClass(_hover).siblings().removeClass(_hover);
        _sarr.eq(_index).css("display", "block").siblings().css("display", "none");
    });
}

//导航下拉
function indexBotNav(objid) {
    var _arr = $("#" + objid + " dl");
    _arr.hover(function () {
        if ($(this).find("dd").is(":animated")) {
            $(this).find("dd").stop(true, true);
        }
        $(this).find("dd").slideDown(200);
    }, function () {
        if ($(this).find("dd").is(":animated")) {
            $(this).find("dd").stop(true, true);
        }
        $(this).find("dd").slideUp(200);
    });
}

//图片展示展示
function imageAllShow(showid, showlast, shownext, menuid, menulast, menunext, _width, _part, _num, nowname, winshowid, textid, textarrid) {
    var _show = $("#" + showid);
    var _showl = $("#" + showlast);
    var _shown = $("#" + shownext);
    var _menu = $("#" + menuid);
    var _menul = $("#" + menulast);
    var _menun = $("#" + menunext);
    var _move = _width + _part;//每次移动的宽度
    var _menuw = (_width + _part) * _num;//计算menu总宽度
    var _index = 0;//当前数量索引
    var _arr = $("#" + menuid + " a");
    var _box = $("#" + menuid + " div");
    var _length = _arr.length;
    var _now = _box.css("left");
    var _text = $("#" + textid);

    var _textarr = $("#" + textarrid + " li");

    //这里是弹出窗的东西
    var _winshow = $("#" + winshowid);

    //必要样式赋值
    _menu.css({ "width": _menuw + "px", "overflow": "hidden" });

    //第一次赋值
    _show.empty().append(_arr.eq(0).find("img").clone());
    _show.append(_textarr.eq(0).find("p").clone());
    _winshow.empty().append(_arr.eq(0).find("img").clone());
    _text.html(_arr.eq(0).find("p").html());
    _arr.eq(0).addClass(nowname);


    //鼠标悬停menu方法
    _arr.hover(function () {
        _index = $(this).index();
        _text.html(_arr.eq(_index).find("p").html());
        _show.empty().append(_arr.eq(_index).find("img").clone());

        _show.append(_textarr.eq(_index).find("p").clone());

        _winshow.empty().append(_arr.eq(_index).find("img").clone());

        _arr.eq(_index).addClass(nowname).siblings().removeClass(nowname);
    });

    //下一个事件
    var _nextimage = function () {
        _arr = _menu.find("a");
        _length = _arr.length;
        _index = _menu.find("." + nowname).index();
        _now = _box.css("left");//当前box位置

        if (_index < _length - 1) {
            _index++;
            _text.html(_arr.eq(_index).find("p").html());
            _show.empty().append(_arr.eq(_index).find("img").clone());
            _show.append(_textarr.eq(_index).find("p").clone());
            _winshow.empty().append(_arr.eq(_index).find("img").clone());
            _arr.eq(_index).addClass(nowname).siblings().removeClass(nowname);

            var _max = _menuw - (_index * _move);//临界点位置
            _max = _max + "px";
            if (_now == _max) {
                _box.animate({ "left": "-=" + _move + "px" }, 200);
            }

        }//判断少于总数时才会跳下一个        
    };
    _menun.click(function () { _nextimage(); });
    _shown.click(function () { _nextimage(); });

    //上一个事件
    var _lastimage = function () {
        _arr = _menu.find("a");
        _length = _arr.length;
        _index = _menu.find("." + nowname).index();
        _now = _box.css("left");//当前box位置

        if (_index > 0) {
            _index--;
            _text.html(_arr.eq(_index).find("p").html());
            _show.empty().append(_arr.eq(_index).find("img").clone());
            _show.append(_textarr.eq(_index).find("p").clone());
            _winshow.empty().append(_arr.eq(_index).find("img").clone());
            _arr.eq(_index).addClass(nowname).siblings().removeClass(nowname);

            var _max = -(_index * _move) - _move;//临界点位置
            _max = _max + "px";
            if (_now == _max) {
                _box.animate({ "left": "+=" + _move + "px" }, 200);
            }

        }//判断少于总数时才会跳下一个        
    };
    _menul.click(function () { _lastimage(); });
    _showl.click(function () { _lastimage(); });

    //幻灯片播放部分
    var _cartoon;

    _arr.click(function () {
        $(".picshowbig").slideDown(500);
        _cartoon = setInterval(function () {
            _nextimage();
        }, 5000);
    });
    $("#imagesallshow").click(function () {
        $(".picshowbig").slideDown(500);
        _cartoon = setInterval(function () {
            _nextimage();
        }, 10000);
    });
    $(".winshow_next").click(function () { _nextimage(); });
    $(".winshow_last").click(function () { _lastimage(); });
    $(".winshow_close").click(function () {
        $(".picshowbig").slideUp(500);
        clearInterval(_cartoon);
    });
}