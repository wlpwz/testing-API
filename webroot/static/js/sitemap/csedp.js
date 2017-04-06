(function(){
	var SiteSearch = function(){
		this._order_ele = ["day","hour","site","cse_recharge","spider_recharge","all_recharge","add_recharge","del_recharge"];
		this._init();
	}
	
	SiteSearch.prototype._init = function(){
		this.pages();
		this.search();
		this.order();
	}
	
	SiteSearch.prototype.search = function(){
		$('#search_btn').bind('click', function(){
			var keyword = $('#keyword').val();
			window.location.href = '?r=cselog/csedp' + '&keyword='+ keyword;
		});
	}

	SiteSearch.prototype.pages = function(){
		var pagesize = $('#pagesize').html();

		var url = '?r=cselog/csedp' + '&pagesize='+ pagesize;
		var obj = {count:$('#count').html(), page:$('#pagenum').html(), pagesize:pagesize,url:url};
		new window.page(obj);
  
	}
	
	SiteSearch.prototype.order = function(){
		for(var i=0; i<this._order_ele.length; ++i)
		{
			$(site_search.rows[0].cells[i]).bind('click',{order:this._order_ele[i]},function(e){
				var seq=orderflag.innerText;
				if(seq=="" || seq=="asc"){
					seq="desc";
				}else{
					seq="asc";
				}
				window.location.href = '?r=cselog/csedp' + '&orderby=' + e.data.order + '&seq='+ seq + '&page=1&pagesize=20';
			});
		}
	}
	
	new SiteSearch();


})();
