/**
 * 业务开发Base库
 * author lifayu@baidu.com
 * date 2011年8月5日 17:37:18
 */
var Info = Info || {};
window["$INFO$"] = {};
//用于存储对象实例
window["$INFO$"]._instances = {};
//生成guid
Info.guid = (function(){
    var guid = 1;
    return function(){
        return "Info__" + (guid++).toString(36);
    };
})();
//基类
Info.Class = function(guid){
    this.guid = guid || Info.guid();
    window["$INFO$"]._instances[this.guid] = this;
};
Info.Base = {
    id:"",
    uiType:"",
    getId:function(key){
        var ui = this,idPrefix;
        idPrefix = "info-"+ui.uiType + "--" + (ui.id ? ui.id : ui.guid);
        return key ? idPrefix + "-" + key : idPrefix;
    },
    getClass:function(key){
        var me = this,className = me.classPrefix;
        if(key){
            className += "-" + key;
        }
        return className;
    },
    init:function(){},
    getMain:function(){
        return $("#"+me.getId());
    },
    renderMain:function(){
        var ui = this;
        ui.getMain.attr("data-guid",ui.guid);
    },
    getCallRef:function(){
        return "window['$INFO$']._instances['"+this.guid+"']";
    },
    getCallString:function(fn){
        var i=0,arg = Array.prototype.slice.call(arguments,1),
            len = arg.length;
        for(;i<len;i++){
            if(typeof arg[i] == "string"){
                arg[i] = "'" + arg[i] + "'";
            }
        }
        return this.getCallRef()
                + '.' + fn + '('
                + arg.join(",") + ');';
    },
    dispatchEvent:function(evt){
        var me = this;
        if(evt && me[evt]){
            return me[evt].apply(me,Array.prototype.slice.call(arguments,1));
        }
    },
	ondispose:function(){
		delete window["$INFO$"]._instances[this.guid];
	}
};
Info.createClass = function(constructor,opts){
    opts = opts || {};
    var superClass = opts.superClass || Info.Class;
    //真正的构造函数
    var ui = function(opt){
        var me = this;
        opt = opt || {};
        superClass.call(me,(opt.guid || ""));
        constructor.apply(me);
        $.extend(me,opts,opt);
        me.classPrefix = (me.classPrefix || "info") + "-" + me.uiType.toLowerCase();
        me.init();
    };
    C = function(){};
    C.prototype = superClass.prototype;
    var fp = ui.prototype = new C();
    for(var i in Info.Base){
        fp[i] = Info.Base[i];
    }
    ui.extend = function(json){
        for(var i in json){
            ui.prototype[i] = json[i];
        }
        return ui;
    };
    return ui;
};
Info.format = function(str,opts){
    str = String(str);
    return str.replace(/#{(.+?)}/g,function(match,key){
        var replacer = opts[key];
        if(typeof replacer == "function"){
            replacer = replacer(key);
        }
        return ('undefined' == typeof replacer ? '' : replacer);
    });
};
Info.g = function(id){
    return $("#" + id);
};
Info.q = function(clazz){
	return $("."+clazz);
}
