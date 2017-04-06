(function(){
	var Cse_CrawlPress = function(){
		this._order_ele = ["timestamp", "site", "value","type","url_total_num","sample_url_num","crawl_url_num","crawl_url_ok","crawl_url_dead","crawl_url_error","status"];
		this._init();
	}
	
	Cse_CrawlPress.prototype._init = function(){
		this.pages();
		this.search();
		this.order();
	}
	
	Cse_CrawlPress.prototype.search = function(){
		$('#search_btn').bind('click', function(){
			var keyword = $('#keyword').val();
			window.location.href = '?r=cse/crawlpress' + '&keyword='+ keyword;
		});
	}

	Cse_CrawlPress.prototype.pages = function(){
		var pagesize = $('#pagesize').html();

		var url = '?r=cse/crawlpress' + '&pagesize='+ pagesize;
		var obj = {count:$('#count').html(), page:$('#pagenum').html(), pagesize:pagesize,url:url};
		new window.page(obj);
  
	}
	
	Cse_CrawlPress.prototype.order = function(){
		for(var i=0; i<this._order_ele.length; ++i)
		{
		$(crawl_press.rows[0].cells[i]).bind('click',{order:this._order_ele[i]},function(e){
			var seq=orderflag.innerText;
			if(seq=="" || seq=="asc"){
				seq="desc";
			}else{
				seq="asc";
			}
			window.location.href = '?r=cse/crawlpress' + '&orderby=' + e.data.order + '&seq='+ seq + '&page=1&pagesize=20';
		});
		}
	}
	
	new Cse_CrawlPress();


})();
