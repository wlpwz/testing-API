/**
 * @require Base.js,jquery.js
 * @author lifayu@baidu.com
 */
var Info = Info || {};
Info.ui = Info.ui || {};
/**
 * 背景遮罩层
 */
Info.ui.Mask = Info.createClass(function(){
},{
	uiType:"mask",
	tplString:"<div class='#{wrap}' id='#{id}' style='z-index:#{zIndex}'></div>",
	getString:function(){
		var me = this;
		return Info.format(me.tplString,{
			wrap:me.getClass("wrap"),
			iframe:me.getClass("iframe"),
			id:me.getId(),
			zIndex:me.zIndex || 9999
		});
	},
	init:function(){
		var me = this;
		$(me.getString()).appendTo("body");
		me.show();
	},
	show:function(){
		var me = this;
		Info.g(me.getId()).show();
	},
	hide:function(){
		var me = this;
		Info.g(me.getId()).hide();
	},
	close:function(){
		var me = this;
		Info.g(me.getId()).remove();
		me.dispatchEvent("ondispose");
	}
});
/**
 * info.ui.dialog
 * @author mfylee
 * @config {int} width
 * @config {String} info 
 * @config {String} title
 * @config {String} html
 * @config {Boolean} draggable 
 * @config {Array} buttons {clazz,text,onclick}
 */
Info.ui.Dialog = Info.createClass(function(){
	this.buttons = [];
	this.width = 300;
	this.type = "info";
	this.draggable = true;
	this.content = "";
    this.once = true; //is hide or close on click the x
},{
	uiType:"dialog",
	tplString:'<div class="dialog-layer #{layer}" style="#{style}" id="#{id}"><div class="dialog-bg #{bg}"><div class="dialog-content #{content}"><div class="dialog-title #{title} #{type}">#{titleText}</div><a href="javascript:void(0);" onclick="#{onclose}" class="dialog-close #{close}"></a><div class="dialog-prompt #{prompt}" style="width:#{width}px;"><div class="dialog-inner #{inner}">#{innerContent}</div><div class="dialog-footer #{footer}">#{buttons}</div></div></div></div></div>',
	tplButtons:'<a href="javascript:void(0);" onclick="#{onclick}" class="dialog-btn #{clazz}"><span>#{text}</span></a>',
	getButtonsString:function(btns){
		var me = this;
		btns = btns || me.buttons;
		var ret = [];
		$.each(btns,function(i,item){
			ret.push(Info.format(me.tplButtons,{
				clazz:me.getClass(item.clazz || "btn-ok"),
				text:item.text,
				onclick:me.getCallString(item.onclick)
			}));
		});
		return ret.join("");
	},
	getString:function(){
		var me = this;
		return Info.format(me.tplString,{
			id:me.getId(),
			style:"margin-left:-"+(me.width/2)+"px;z-index:"+(me.zIndex || 9999),
			layer:me.getClass("layer"),
			bg:me.getClass("bg"),
			content:me.getClass("content"),
			title:me.getClass("title"),
			type:me.getClass(me.type),
			titleText:me.title,
			close:me.getClass("close"),
			prompt:me.getClass("prompt"),
			inner:me.getClass("inner"),
			width:me.width || 200,
			innerContent:me.content,
			footer:me.getClass("footer"),
			buttons:me.getButtonsString(),
			onclose:me.once == true ? me.getCallString("close") : me.getCallString("hide")
		});
	},
	init:function(){
		var me = this;
		me.dispatchEvent("beforeOpen");
		me.mask = new Info.ui.Mask({zIndex:me.zIndex});
		$(me.getString()).appendTo("body");
		if(me.buttons.length > 0){
			Info.g(me.getId()).find("."+me.getClass("footer")).show().find("a:last").focus();
		}
        me.show();
		me._setTopPx();
		if(me.draggable){
            try{
                Info.g(me.getId()).draggable({
                    cancel:"."+me.getClass("prompt"),
                    start:function(event,ui){
                    },
                    drag:function(event,ui){
                    },
                    stop:function(event,ui){
                    }
                });
            }catch(e){
            }
		}
		me.dispatchEvent("afterOpen");
	},
	setTitle:function(title){
		var me = this;
		Info.g(me.getId()).find("."+me.getClass("title")).html(title);
	},
	setContent:function(html){
		var me = this;
		Info.g(me.getId()).find("."+me.getClass("inner")).html(html);
	},
	setButtons:function(btns){
		var me = this;
		Info.g(me.getId()).find("."+me.getClass("footer")).show().html(me.getButtonsString(btns));
	},
    removeButtons:function(){
		var me = this;
		Info.g(me.getId()).find("."+me.getClass("footer")).html("");
    },
	width:function(width){
		var me = this;
		Info.g(me.getId()).find("."+me.getClass("prompt")).width(width);
	},
	_setTopPx:function(){
		var me = this;
		var windowHeight,scrollTop,dialogHeight;
		windowHeight = $(window).height();
		scrollTop = $(document).scrollTop();
		dialogHeight = Info.g(me.getId()).height();
		Info.g(me.getId()).css({
			top:windowHeight/2+scrollTop-dialogHeight/2
		});
	},
	close:function(){
		var me = this;
		if(me.dispatchEvent("beforeClose") == false){
			return false;
		}
		Info.g(me.getId()).remove();
		me.mask.close();
		me.dispatchEvent("afterClose");
		me.dispatchEvent("ondispose");
	},
	show:function(){
		var me = this;
		me.mask.show();
		Info.g(me.getId()).show();
        me.dispatchEvent("onshow");
	},
	hide:function(){
		var me = this;
		me.mask.hide();
		Info.g(me.getId()).hide();
	}
});
Info.alert = Info.ui.alert = function(msg,type,callback,opts){
    var type = type || "info";
    type = type.toLowerCase();
    var btn1 = [{
        text:"确定",onclick:"ok"
    }];
    var btn2 = [{
        text:"确定",onclick:"ok"
    },{ 
        text:"取消",onclick:"cancel",clazz:"btn-cancel"
    }];
    var cfg = {
        content:"<div class='info-alert info-alert-"+type+"'>"+msg+"</div>",
        title:"消息提示",
        width:300,
        draggable:true,
        ok:function(){
            if(typeof callback == "function"){
                callback();
            }
            this.close();
        },
        cancel:function(){
            this.close();
        }
    };
    cfg = $.extend(cfg,opts);
    if(type == "confirm"){
        cfg.buttons = btn2;
    }else{
        cfg.buttons = btn1;
    }
    var dialog =  new Info.ui.Dialog(cfg);
    Info.g(dialog.getId()).find("."+dialog.getClass("footer")).css("text-align","center");
    return dialog;
};
/**
 * 可以在delay之后自动关闭
 * @param {String} msg
 * @param {int} delay(ms)
 */
Info.layer = function(msg,delay,callback){
	var dialog = Info.alert(msg,"INFO",callback);
	setTimeout(function(){
		dialog.close();
		if(typeof callback == "function"){
			callback();
		}
	},delay);
};
/**
 * iframe弹出层
 */
Info.ui.Layerbox = Info.createClass(function(){
	//Constructor
	this.zIndex = 9999;
},{
	uiType:"layerbox",
	tplString:'<div id="#{id}" class="#{wrap}" style="z-index:#{zIndex}"><div class="#{close}" onclick="#{closeHandler}"></div><div id="content" class="#{contentClass}"><iframe src="#{url}" frameborder="0" marginheight="0"></iframe></div></div>',
	getString:function(){
		var me = this;
		return Info.format(me.tplString,{
			id:me.getId(),
			content:me.getId("content"),
			wrap:me.getClass("wrap"),
			close:me.getClass("close"),
			contentClass:me.getClass("content"),
			url:me.url,
			closeHandler:me.getCallString("close"),
			zIndex:me.zIndex || 9999
		});
	},
	init:function(){
		var me = this;
		me.mask = new Info.ui.Mask({zIndex:me.zIndex});
		$(me.getString()).appendTo("body");
		var iframe = Info.g(me.getId()).find("iframe")[0];
		function resetIframe(){
			me.reset();
		}
		me.iframeTimer = window.setInterval(function(){
			me.reset();
		},200);
		iframe.contentWindow.onload = resetIframe;
	},
	reset:function(){
		var me = this;
		var iframe = Info.g(me.getId()).find("iframe")[0];
		try{
			var bHeight = iframe.contentWindow.document.body.scrollHeight;
			var dHeight = iframe.contentWindow.document.documentElement.scrollHeight;		
			var height = Math.max(bHeight, dHeight);
			iframe.height =  height;
			var bWidth = iframe.contentWindow.document.body.scrollWidth;
			var dWidth = iframe.contentWindow.document.documentElement.scrollWidth;		
			var width = Math.max(bWidth, dWidth);
			iframe.width =  width;

			var left = ($(window).width() - width)/2;
			var top = ($(window).height() - height)/2;
			if(top < 10){
				top = 10;
			}
			Info.g(me.getId()).css({
				left:left,
				top:top
			});
		}catch (ex){}
	},
	close:function(){
		var me =this;
		window.clearInterval(me.iframeTimer);
		me.mask.close();
		Info.g(me.getId()).remove();
	}
});
//顶部消息
Info.ui.Message = Info.createClass(function(){
},{
    uiType:"msg",
    delay:2000,
    msg:"",
    tplString:"<div id='#{id}' class='#{clazz}'>#{msg}</div>",
    getString:function(){
        var me = this;
        return Info.format(me.tplString,{
            id:me.getId(),
            clazz:me.getClass("wrap"),
            msg:me.msg
        });
    },
    init:function(){
        var me = this;
        $("body").append(me.getString());
        var el = Info.g(me.getId());
        el.css("marginLeft",parseInt(el.width(),10)/2*-1);
        setTimeout(function(){
            me.destory();
        },me.delay);
    },
    destory:function(){
        var me = this;
        Info.g(me.getId()).slideUp(function(){
            Info.g(me.getId()).remove();
        });
    }
});
