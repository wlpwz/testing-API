(function(){
	var CseListCount = function(){
		this._order_ele = ["submit_time","tid","rule","t_type","trans_per"];
		this._init();
	}
	
	CseListCount.prototype._init = function(){
		this.pages();
		this.search();
		this.order();
	}
	
	CseListCount.prototype.search = function(){
		$('#search_btn').bind('click', function(){
			var keyword = $('#keyword').val();
			var day = $('#day').text();
			var baidu_prod = $('#baidu_prod').text();
			window.location.href = '?r=csenew/cselistcount' + '&keyword='+ keyword +'&day=' + day + '&baidu_prod=' + baidu_prod;
		});
	}

	CseListCount.prototype.pages = function(){
		var pagesize = $('#pagesize').html();

		var url = '?r=csenew/cselistcount' + '&pagesize='+ pagesize;
		var obj = {count:$('#count').html(), page:$('#pagenum').html(), pagesize:pagesize,url:url};
		new window.page(obj);
  
	}
	
	CseListCount.prototype.order = function(){
		for(var i=0; i<this._order_ele.length; ++i)
		{
			$(table_custom_search_site_list.rows[0].cells[i]).bind('click',{order:this._order_ele[i]},function(e){
				var seq=orderflag.innerText;
				if(seq=="" || seq=="asc"){
					seq="desc";
				}else{
					seq="asc";
				}
				window.location.href = '?r=csenew/cselistcount' + '&orderby=' + e.data.order + '&seq='+ seq + '&page=1&pagesize=20';
			});
		}
	}
	
	new CseListCount();


})();
