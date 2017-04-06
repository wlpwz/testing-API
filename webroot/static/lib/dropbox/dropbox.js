/**
 * 下拉框控件
 * @author lifayu@baidu.com
 * @date 2011年7月14日 14:03:58
 * @param {int}opts.width
 * @param {jQuery}opts.element
 * @param {Array}opts.data {Object}opts.data[i] = {value:xx,text:xx}
 * @param {Function}opts.onchange,onclick,ondbclick,onmouseover...
 */
//构造函数
//{jQuery} element
//{int} selectedIndex
//{Array} data
//{String} value
//{jQuery} list 下拉<ul>
function DropBox(opts){
	var me = this,el = opts.element;
	var opts = $.extend({
		onchange:function(){},
		data:[]
	},opts);
    me.element = el;
    me.selectedIndex = 0;
    me.data = opts.data;
    me.onchange = opts.onchange;
	if(me.data.length == 0){
		me.data = [{
			value:"",
		    text:"请选择"
		}];
	}
    //获取selectedIndex
    $.each(me.data,function(i,item){
        if(item.selected == true){
            me.selectedIndex = i;
            return false;
        }
    });
	el.addClass("dropbox");
    //绑定事件
    var events = "click mouseout mouseover dbclick mousemove mousedown mouseup";
    $.each(events.split(" "),function(i,item){
        el.bind(item,function(event){
            if(typeof opts["on"+item] == "function"){
                opts["on"+item].call(me,event);
            }
        });
    });
	me.value = me.data[me.selectedIndex].value;
	el.append("<div class='dropbox-text' style='width:"+(opts.width - 16)+"px'>"+me.data[me.selectedIndex].text+"</div>");
	el.append("<div class='dropbox-arrow'></div>");
	el.width(opts.width);
	me.list = $("<ul>").addClass("dropbox-list");
	$.each(me.data,function(i,item){
		var li = $("<li>");
		li.html(item.text);
		//li.css("width",opts.width-4);
		//li.data("value",item.value);
		//li.data("index",i);
		li.attr("val",item.value);
		li.attr("index",i);
		me.list.append(li);
	});
	me.list.css("width",opts.width);
	me.list.appendTo($("body"));

	el.click(function(event){
		var offset = el.offset();
		me.list.css({
			top:offset.top + el.height() + 1,
			left:offset.left
		});
		event.stopPropagation();
		$(".dropbox-list").not(me.list).hide();
        $(".dropbox_open").not(this).removeClass("dropbox_open");
        $(this).toggleClass("dropbox_open");
		me.list.toggle();
	});
	me.list.find("li").bind("click",function(){
		var v = $(this).attr("val");
		if( v != me.value){
			opts.onchange.call(me,v);
		}
		el.find(".dropbox-text").text($(this).text());
		me.value = v;
        me.selectedIndex = $(this).attr("index");
	});
	$(document).bind("click.dropbox",function(){
		$(".dropbox-list").hide();
        el.removeClass("dropbox_open");
	});
    me.el = el;
    //初始化
    //opts.onchange.call(me,me.value);
}
function MyDropBox(opts){
	var me = this,el = opts.element;
	var opts = $.extend({
		onchange:function(){},
		data:[]
	},opts);
    me.element = el;
    me.selectedIndex = 0;
    me.data = opts.data;
	if(me.data.length == 0){
		me.data = [{
			value:"",
		    text:"请选择"
		}];
	}
    //获取selectedIndex
    $.each(me.data,function(i,item){
        if(item.selected == true){
            me.selectedIndex = i;
            return false;
        }
    });
	el.addClass("dropbox");
    //绑定事件
    var events = "click mouseout mouseover dbclick mousemove mousedown mouseup";
    $.each(events.split(" "),function(i,item){
        el.live(item,function(event){
            if(typeof opts["on"+item] == "function"){
                opts["on"+item].call(me,event);
            }
        });
    });
	me.value = me.data[me.selectedIndex].value;
	el.append("<div class='dropbox-text' style='width:"+(opts.width - 16)+"px'>"+me.data[me.selectedIndex].text+"</div>");
	el.append("<div class='dropbox-arrow'></div>");
	el.width(opts.width);
	me.list = $("<ul>").addClass("dropbox-list");
	$.each(me.data,function(i,item){
		var li = $("<li>");
		li.html(item.text);
		//li.css("width",opts.width-4);
		//li.data("value",item.value);
		//li.data("index",i);
		li.attr("val",item.value);
		li.attr("index",i);
		me.list.append(li);
	});
	me.list.css("width",opts.width);
	me.list.appendTo($("body"));

	el.click(function(event){
		var offset = el.offset();
		me.list.css({
			top:offset.top + el.height() + 1,
			left:offset.left
		});
		event.stopPropagation();
		$(".dropbox-list").not(me.list).hide();
        $(".dropbox_open").not(this).removeClass("dropbox_open");
        $(this).toggleClass("dropbox_open");
		me.list.toggle();
	});
	me.list.find("li").live("click",function(){
		var v = $(this).attr("val");
		if( v != me.value){
			opts.onchange.call(me,v);
		}
		el.find(".dropbox-text").text($(this).text());
		me.value = v;
        me.selectedIndex = $(this).attr("index");
	});
	$(document).live("click.dropbox",function(){
		$(".dropbox-list").hide();
        el.removeClass("dropbox_open");
	});
    //初始化
    //opts.onchange.call(me,me.value);
}
//设置值
DropBox.prototype.setValue = function(v){
	var me =this;
	$.each(me.list.find("li"),function(i,item){
		if($(item).attr("val") == v){
			$(item).click();
			return false;
		}
	});
}
//获取选中的值
DropBox.prototype.getValue = function(){
	return this.value;
}
//获取选中项
DropBox.prototype.getSelectedItem = function(){
    return this.data[this.selectedIndex];
}
DropBox.prototype.addItem = function(item,value) {
    var me = this;
    var index = me.list.children("li").length;
    var li = $("<li>");
    li.html(item);
    li.attr("val",value);
    li.attr("index",index);
	li.click(function(){
        console.log($(this));
		var v = $(this).attr("val");
		if( v != me.value){
			me.onchange.call(me,v);
		}
		me.el.find(".dropbox-text").text($(this).text());
		me.value = v;
        me.selectedIndex = $(this).attr("index");
	});
    me.list.append(li);
    me.setValue(value);
    
}


function Combox(opts){
	var me = this,el = opts.element;
    me.element = el;
	el.addClass("dropbox");
    me.input = $("<input class='combox_input' value='"+opts.defaultValue+"' type='text' style='border:none;'/>");
    $("<span></span>").appendTo(el).append(me.input);
	el.width(opts.width);
	me.list = $("<ul>").addClass("dropbox-list");
	$.each(opts.data,function(i,item){
		var li = $("<li>");
		li.html(item);
		//li.css("width",opts.width-4);
		me.list.append(li);
	});
	me.list.css("width",opts.width);
	me.list.appendTo($("body"));
    el.click(function(event){
		event.stopPropagation();
    });
	me.input.focus(function(event){
		var offset = el.offset();
		me.list.css({
			top:offset.top + el.height() + 1,
			left:offset.left
		});
		$(".dropbox-list").not(me.list).hide();
        me.list.show();
	});
    me.list.find("li").click(function(){
        me.input.val($(this).text());
    });
	$(document).bind("click.dropbox",function(){
		$(".dropbox-list").hide();
        el.removeClass("dropbox_open");
	});
}
Combox.prototype.setValue = function(v){
    this.input.val(v);
}
/////////////////////////////////////////
/**
 * @param {jQuery}opts.element 目标元素
 * @param {int}opts.width 宽度
 * @param {String}opts.content 下拉框html片段
 * @param {String}opts.defaultText 默认显示内容
 */
function MultiDropBox(opts){
	var me = this,el = opts.element;
    me.element = el;
	el.addClass("dropbox");
	el.append("<div class='dropbox-text' style='width:"+(opts.width - 16)+"px'>"+opts.defaultText+"</div>");
	el.append("<div class='dropbox-arrow'></div>");
	el.width(opts.width);
	me.list = $(opts.content).addClass("dropbox-list");
    me.list.click(function(event){
		event.stopPropagation();
    });
	me.list.appendTo($("body"));

	el.click(function(event){
		var offset = el.offset();
		me.list.css({
			top:offset.top + el.height() + 1,
			left:offset.left
		});
		event.stopPropagation();
		$(".dropbox-list").not(me.list).hide();
        $(".dropbox_open").not(this).removeClass("dropbox_open");
        el.toggleClass("dropbox_open");
		me.list.toggle();
	});
	$(document).bind("click.dropbox",function(){
		$(".dropbox-list").hide();
        el.removeClass("dropbox_open");
	});
}
MultiDropBox.prototype.hideLayer = function(){
    this.list.hide();
}

function GroupDropSearchBox(opts){
	var me = this,el = opts.element;
    me.element = el;
    me.data = opts.data;
    // data = {ps:[{},{}],ns:[{},{}]};
    var htm = [],defaultValue = "";
    $.each(opts.data,function(i,item){
        htm.push("<dl><dt>"+i+"</dt>");
        $.each(item,function(j,it){
            if(it.selected){
                defaultValue = it.text;
                me.value = it.value;
            } 
            htm.push("<dd val='"+it.value+"' title='"+it.text+"'>"+it.text+"</dd>");
        });
        htm.push("</dl>");
    });
    if(defaultValue == ""){
        for(var i in opts.data){
            if(opts.data[i].length > 0){
                defaultValue = opts.data[i][0].text;
                me.value = opts.data[i][0].value;
                break;
            }
        }
    }

	el.addClass("dropbox");
	el.append("<div><input id='searchbox' class='dropbox-text' style='width:"+(opts.width - 24)+"px' type='text' value='"+defaultValue+"'></div>");
	el.append("<div class='dropbox-arrow'></div>");
	el.width(opts.width);
	//me.list = $(opts.content).addClass("dropbox-list");
    me.list = $("<div>"+htm.join("")+"</div>").addClass("dropbox-list");
	me.list.width(opts.width);
	me.list.appendTo($("body"));

	el.click(function(event){
		var offset = el.offset();
		me.list.css({
			top:offset.top + el.height() + 1,
			left:offset.left
		});
		event.stopPropagation();
		$(".dropbox-list").not(me.list).hide();
        $(".dropbox_open").not(this).removeClass("dropbox_open");
        el.toggleClass("dropbox_open");
		me.list.toggle();
	});
	me.list.find("dd").bind("click",function(){
		var v = $(this).attr("val");
		if( v != me.value){
			opts.onchange.call(me,v);
		}
		el.find(".dropbox-text").val($(this).text());
		me.value = v;
	});
    me.list.find("dt").bind("click",function(event){
        event.stopPropagation();
    });
	$(document).bind("click.dropbox",function(){
		$(".dropbox-list").hide();
        el.removeClass("dropbox_open");
	});
}
function SuperGroupDropBox(opts){
	var me = this,el = opts.element;
    me.element = el;
    me.data = opts.data;
    var buildHtm = function(data,isFirst) {
        var htm = [];
        $.each(data,function(i,superItem){
            htm.push("<dl><dt style='font-size:14px;height:22px;'>"+i+"</dt>");
            $.each(superItem, function(k,item){
                var dtClass = "";
                if (typeof(item[0].status) != "undefined") {
                    var statusNum = 0;
                    $.each(item,function(j,it){
                        if (it.status === "0") {
                            statusNum ++;
                        }
                    });
                    if (statusNum == 0) {
                        dtClass = "class='red'";
                    } else if(statusNum == item.length) {
                        dtClass = "class='green'";
                    } else {
                        dtClass = "class='yellow'";
                    }
                }
                htm.push("<dt "+ dtClass +" style='padding-left:10px;'>"+k+"</dt>");
                $.each(item,function(j,it){
                    if(it.selected && isFirst){
                        defaultValue = it.text;
                        me.value = it.value;
                        me.text = it.text;
                    }
                    if("undefined" != typeof(it.text)){
                        var ddClass = "";
                        if (it.status === "0") {
                            ddClass = "class='green'";
                        } else if(it.status === "1") {
                            ddClass = "class='yellow'";
                        } else if(it.status === "2") {
                            ddClass = "class='red'";
                        }
                        htm.push("<dd "+ ddClass +" val='"+it.value+"' title='"+it.text+"'>"+it.text+"</dd>");
                    }
                });
            });
            htm.push("</dl>");
        });
        return htm;
    };
    var bindClick = function(){
    	me.list.find("dd").bind("click",function(){
    		var v = $(this).attr("val");
    		if( v != me.value){
    			opts.onchange.call(me,v);
    		}
    		el.find(".dropbox-text").val($(this).text());
    		me.value = v;
            me.text = $(this).text();
            console.log(me.value,me.text);
            me.list.html(buildHtm(opts.data).join(""));
            bindClick();
    	});
        me.list.find("dt").bind("click",function(event){
            event.stopPropagation();
        });
    
    };
    // data = {ps:[{},{}],ns:[{},{}]};
    var defaultValue = "",
        htm = buildHtm(opts.data, true);
    if(defaultValue == ""){
        for(var i in opts.data){
            if(opts.data[i].length > 0){
                defaultValue = opts.data[i][0].text;
                me.value = opts.data[i][0].value;
                me.text = opts.data[i][0].text;
                break;
            }
        }
    }
	el.addClass("dropbox");
	//el.append("<div class='dropbox-text'>"+defaultValue+"</div>");
	el.append("<input class='dropbox-text' type='text' value='" + defaultValue + "'>");
	//el.append("<div class='dropbox-text' style='width:"+(opts.width - 16)+"px'>"+defaultValue+"</div>");
	el.append("<div class='dropbox-arrow'></div>");
	el.width(opts.width);
    el.find(".dropbox-text").width(el.width() - 16);
	//me.list = $(opts.content).addClass("dropbox-list");
    me.list = $("<div>"+htm.join("")+"</div>").addClass("dropbox-list");
	me.list.width(el.width());
	//me.list.width(opts.width);
	me.list.appendTo($("body"));

	el.click(function(event){
		var offset = el.offset();
		me.list.css({
			top:offset.top + el.height() + 1,
			left:offset.left
		});
		event.stopPropagation();
		$(".dropbox-list").not(me.list).hide();
        $(".dropbox_open").not(this).removeClass("dropbox_open");
        el.toggleClass("dropbox_open");
		me.list.toggle();
	});
    bindClick();
	$(document).bind("click.dropbox",function(){
		$(".dropbox-list").hide();
        el.removeClass("dropbox_open");
	});
    me.element.find("input").keyup(function(){
        var inputText = $(this).val();
        if (inputText == "") {
            me.list.html(buildHtm(opts.data).join("")).show();
            bindClick();
            return;
        }
        var tempData = {}, tempDataNum = 0;
        $.each(opts.data, function(i, superItem) {
            var superMenu = {},superMenuNum = 0;
            $.each(superItem, function(j, item) {
                if (j.toUpperCase().indexOf(inputText.toUpperCase()) >= 0) {
                    superMenu[j] = item;
                    superMenuNum ++;
                } else {
                    var superMenu2 = [];
                    $.each(item, function(k, it) {
                        if (it.text.toUpperCase().indexOf(inputText.toUpperCase()) >= 0) {
                            superMenu2.push(it);
                        }
                    });
                    if (superMenu2.length > 0) {
                        superMenu[j] = superMenu2;
                        superMenuNum ++;
                    }
                }
            });
            if (superMenuNum > 0) {
                tempData[i] = superMenu;
                tempDataNum ++;
            }
        });
        me.list.html("");
        if (tempDataNum > 0) {
            me.list.html(buildHtm(tempData).join("")).show();
            bindClick();
        }
    }).focus(function(){
        $(this).val("");
        $(".dropbox-arrow").css("background-position","center right");
        me.list.html(buildHtm(opts.data).join(""));
        bindClick();
    }).blur(function(){
        $(".dropbox-arrow").css("background-position","center left");
        $(this).val(me.text);    
    });
}
SuperGroupDropBox.prototype.getValue = function(){
    return this.value;
}
SuperGroupDropBox.prototype.setValue = function(v){
    var me = this;
    var text = "";
    $.each(me.data,function(i,item){
        $.each(item,function(j,it){
            $.each(it, function(k, iit){
                if(iit.value == v){
                    text = iit.text;
                }
            });
        });
    });
    text = text=="" ? v : text;
    me.element.find(".dropbox-text").val(text);
    me.value = v;
}
function SearchGroupDropBox(opts){
	var me = this,el = opts.element;
    me.element = el;
    me.data = opts.data;
    var buildHtm = function(data,isFirst) {
        var htm = [];
        $.each(data,function(i,item){
            htm.push("<dl><dt style='font-size:14px;height:22px;'>"+i+"</dt>");
                $.each(item,function(j,it){
                    if(it.selected && isFirst){
                        defaultValue = it.text;
                        me.value = it.value;
                        me.text = it.text;
                    }
                    if("undefined" != typeof(it.text)){
                        htm.push("<dd val='"+it.value+"' title='"+it.text+"'>"+it.text+"</dd>");
                    }
                });
            htm.push("</dl>");
        });
        return htm;
    };
    var bindClick = function(){
    	me.list.find("dd").bind("click",function(){
    		var v = $(this).attr("val");
    		if( v != me.value){
    			opts.onchange.call(me,v);
    		}
    		el.find(".dropbox-text").val($(this).text());
    		me.value = v;
            me.text = $(this).text();
            me.list.html(buildHtm(opts.data).join(""));
            bindClick();
    	});
        me.list.find("dt").bind("click",function(event){
            event.stopPropagation();
        });
    
    };
    // data = {ps:[{},{}],ns:[{},{}]};
    var defaultValue = "",
        htm = buildHtm(opts.data, true);
    if(defaultValue == ""){
        for(var i in opts.data){
            if(opts.data[i].length > 0){
                defaultValue = opts.data[i][0].text;
                me.value = opts.data[i][0].value;
                me.text = opts.data[i][0].text;
                break;
            }
        }
    }
	el.addClass("dropbox");
	//el.append("<div class='dropbox-text'>"+defaultValue+"</div>");
	el.append("<input class='dropbox-text' type='text' value='" + defaultValue + "'>");
	//el.append("<div class='dropbox-text' style='width:"+(opts.width - 16)+"px'>"+defaultValue+"</div>");
	el.append("<div class='dropbox-arrow'></div>");
	el.width(opts.width);
    el.find(".dropbox-text").width(el.width() - 16);
	//me.list = $(opts.content).addClass("dropbox-list");
    me.list = $("<div>"+htm.join("")+"</div>").addClass("dropbox-list");
	me.list.width(el.width());
	//me.list.width(opts.width);
	me.list.appendTo($("body"));

	el.click(function(event){
		var offset = el.offset();
		me.list.css({
			top:offset.top + el.height() + 1,
			left:offset.left
		});
		event.stopPropagation();
		$(".dropbox-list").not(me.list).hide();
        $(".dropbox_open").not(this).removeClass("dropbox_open");
        el.toggleClass("dropbox_open");
		me.list.toggle();
	});
    bindClick();
	$(document).bind("click.dropbox",function(){
		$(".dropbox-list").hide();
        el.removeClass("dropbox_open");
	});
    me.element.find("input").keyup(function(){
        var inputText = $(this).val();
        if (inputText == "") {
            me.list.html(buildHtm(opts.data).join("")).show();
            bindClick();
            return;
        }
        var tempData = {}, tempDataNum = 0;
        $.each(opts.data, function(i, item) {
            if (i.toUpperCase().indexOf(inputText.toUpperCase()) >= 0) {
                tempData[i] = item;
                tempDataNum ++ ;
            } else {
                var superMenu = [];
                $.each(item, function(k, it) {
                    if (it.text.toUpperCase().indexOf(inputText.toUpperCase()) >= 0) {
                        superMenu.push(it);
                    }
                });
                if (superMenu.length > 0) {
                    tempData[i] = superMenu;
                    tempDataNum ++;
                }
            }
        });
        me.list.html("");
        if (tempDataNum > 0) {
            me.list.html(buildHtm(tempData).join("")).show();
            bindClick();
        }
    }).focus(function(){
        $(this).val("");
        $(".dropbox-arrow").css("background-position","center right");
        me.list.html(buildHtm(opts.data).join(""));
        bindClick();
    }).blur(function(){
        $(".dropbox-arrow").css("background-position","center left");
        $(this).val(me.text);    
    });
}
SearchGroupDropBox.prototype.getValue = function(){
    return this.value;
}
SearchGroupDropBox.prototype.setValue = function(v){
    var me = this;
    var text = "";
    $.each(me.data,function(i,item){
        $.each(item,function(j,it){
            if(it.value == v){
                text = it.text;
            }
        });
    });
    text = text=="" ? v : text;
    me.element.find(".dropbox-text").val(text);
    me.value = v;
}


function GroupDropBox(opts){
	var me = this,el = opts.element;
    me.element = el;
    me.data = opts.data;
    // data = {ps:[{},{}],ns:[{},{}]};
    var htm = [],defaultValue = "";
    $.each(opts.data,function(i,item){
        htm.push("<dl><dt>"+i+"</dt>");
        $.each(item,function(j,it){
            if(it.selected){
                defaultValue = it.text;
                me.value = it.value;
            }
            if("undefined" != typeof(it.text)){
                htm.push("<dd val='"+it.value+"' title='"+it.text+"'>"+it.text+"</dd>");
            }
        });
        htm.push("</dl>");
    });
    if(defaultValue == ""){
        for(var i in opts.data){
            if(opts.data[i].length > 0){
                defaultValue = opts.data[i][0].text;
                me.value = opts.data[i][0].value;
                break;
            }
        }
    }

	el.addClass("dropbox");
	el.append("<div class='dropbox-text' style='width:"+(opts.width - 16)+"px'>"+defaultValue+"</div>");
	el.append("<div class='dropbox-arrow'></div>");
	el.width(opts.width);
	//me.list = $(opts.content).addClass("dropbox-list");
    me.list = $("<div>"+htm.join("")+"</div>").addClass("dropbox-list");
	me.list.width(opts.width);
	me.list.appendTo($("body"));

	el.click(function(event){
		var offset = el.offset();
		me.list.css({
			top:offset.top + el.height() + 1,
			left:offset.left
		});
		event.stopPropagation();
		$(".dropbox-list").not(me.list).hide();
        $(".dropbox_open").not(this).removeClass("dropbox_open");
        el.toggleClass("dropbox_open");
		me.list.toggle();
	});
	me.list.find("dd").bind("click",function(){
		var v = $(this).attr("val");
		if( v != me.value){
			opts.onchange.call(me,v);
		}
		el.find(".dropbox-text").text($(this).text());
		me.value = v;
	});
    me.list.find("dt").bind("click",function(event){
        event.stopPropagation();
    });
	$(document).bind("click.dropbox",function(){
		$(".dropbox-list").hide();
        el.removeClass("dropbox_open");
	});
}
GroupDropBox.prototype.getValue = function(){
    return this.value;
}
GroupDropBox.prototype.setValue = function(v){
    var me = this;
    var text = "";
    $.each(me.data,function(i,item){
        $.each(item,function(j,it){
            if(it.value == v){
                text = it.text;
            }
        });
    });
    text = text=="" ? v : text;
    me.element.find(".dropbox-text").text(text);
    me.value = v;
}

GroupDropSearchBox.prototype.getValue = function(){
    return this.value;
}
GroupDropSearchBox.prototype.setValue = function(v){
    var me = this;
    var text = "";
    $.each(me.data,function(i,item){
        $.each(item,function(j,it){
            if(it.value == v){
                text = it.text;
            }
        });
    });
    text = text=="" ? v : text;
    me.element.find(".dropbox-text").val(text);
    me.value = v;
}
