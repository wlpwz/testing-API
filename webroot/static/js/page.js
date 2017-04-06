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
		this._mUrl = config.url;
	}

	Page.prototype.slidePage = function(){
		var count = this._mCount;
		var page = this._mPage;
		var pagesize = this._mPageSize;
		var url = this._mUrl;

        var pageCount = Math.ceil(count/pagesize);	
        var mid = Math.ceil(Page.NUM/2);	
        var total = (pageCount <= Page.NUM)?pageCount:Page.NUM;
        var off = 0;
        
        var html = '';
		if(pageCount > 1){
			if(page == 1){
				html += '<span class="active">';
			}else{
				html += '<span>';
			}
			html += '<a href="' + url +'&page=1">首页</a></span>';
			
            if(pageCount>Page.NUM){
				//超过最大页码时，或未超过最大页码但超过num/2页面时
				(((page-mid+Page.NUM) > pageCount) && ( off = pageCount - Page.NUM)) || ((page>mid) && (off = page - mid)); 
			}

			for(var i = 1; i <= total; i++){
				var n = i + off;
				if(n == page){
					html += '<span class="active">';
				}else{
					html += '<span>';
				}
				html += '<a href="'+ url + '&page=' + n +'">' + n + '</a></span>';
			}

			if(page == pageCount){
                html += '<span class="active">';
            }else{
                html += '<span>';
            }
			html += '<a href="' + url +'&page=' + pageCount + '">尾页</a></span>';
		}
		$('#slidePage').html(html);	

	}

	window.page = Page;

})();
