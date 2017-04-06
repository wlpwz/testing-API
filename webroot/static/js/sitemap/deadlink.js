(function(){
	var DeadLinkRisk = function(){
		this._order_ele = ["site", "submit_count", "stat1_count","stat2_count","stat3_count","dead_ratio"];
		this._init();
	}
	
	DeadLinkRisk.prototype._init = function(){
		this.pages();
		this.search();
		this.order();
	}
	
	DeadLinkRisk.prototype.search = function(){
		$('#search_btn').bind('click', function(){
			var keyword = $('#keyword').val();
			window.location.href = '?r=system2/deadlinkrisk' + '&keyword='+ keyword;
		});
	}

	DeadLinkRisk.prototype.pages = function(){
		var pagesize = $('#pagesize').html();

		var url = '?r=system2/deadlinkrisk' + '&pagesize='+ pagesize;
		var obj = {count:$('#count').html(), page:$('#pagenum').html(), pagesize:pagesize,url:url};
		new window.page(obj);
  
	}
	
	DeadLinkRisk.prototype.order = function(){
		for(var i=0; i<this._order_ele.length; ++i)
		{
		$(deadlinkrisk_sitemap.rows[0].cells[i]).bind('click',{order:this._order_ele[i]},function(e){
			var seq=orderflag.innerText;
			if(seq=="" || seq=="asc"){
				seq="desc";
			}else{
				seq="asc";
			}
			window.location.href = '?r=system2/deadlinkrisk' + '&orderby=' + e.data.order + '&seq='+ seq + '&page=1&pagesize=20';
		});
		}
	}
	
	new DeadLinkRisk();


})();
