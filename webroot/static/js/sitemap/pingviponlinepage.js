(function(){
	var Page = function(config){
		this._init(config);
		this.slidePage();
	}
	Page.NUM = 10;    //显示最大页码个数

	Page.prototype._init = function(config){
		this._mCount = config.count;
		this._mPage = config.page;
		this._mPageSize = config.pagesize;
	}

	Page.prototype.slidePage = function(){
		var count = this._mCount;
		var page = this._mPage;
		var pagesize = this._mPageSize;
		var flag = window.location.href.indexOf("&page");
		if(flag == -1)
		{
			var url = window.location.href;
		}else{
			var url = window.location.href.substr(0,flag);
		}
        var pageCount = Math.ceil(count/pagesize);	
        var mid = Math.ceil(Page.NUM/2);	
        var total = (pageCount <= Page.NUM)?pageCount:Page.NUM;
        var off = 0;

		var html = '<ul class="right">';	
		if(pageCount > 1){
			if(page == 1){
				html += '<li class="disabled">';
			}else{
				html += '<li class="active">';
			}
			html += '<a href="' + url +'&page=1">首页</a></li>';
			
            if(pageCount>Page.NUM){
				//超过最大页码时，或未超过最大页码但超过num/2页面时
				(((page-mid+Page.NUM) > pageCount) && ( off = pageCount - Page.NUM)) || ((page>mid) && (off = page - mid)); 
			}

			for(var i = 1; i <= total; i++){
				var n = i + off;
				if(n == page){
					html += '<li class="disabled">';
				}else{
					html += '<li class="active">';
				}
				html += '<a href="'+ url + '&page=' + n +'">' + n + '</a></li>';
			}

			if(page == pageCount){
                html += '<li class="disabled">';
            }else{
                html += '<li class="active">';
            }
			html += '<a href="' + url +'&page=' + pageCount + '">尾页</a></li>';
		}
		html += '</ul>';
		html += '<span class="total-num">共' + count + '条</span>';
		$('#slidePage').html(html);	

	}
	window.page = Page;
	
})();
