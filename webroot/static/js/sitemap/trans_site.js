(function(){
	var Transite = function(){
		this._order_ele = ["submit_time","tid","rule","t_type","trans_per"];
		this._init();
	}
	
	Transite.prototype._init = function(){
		this.pages();
		this.search();
		this.order();
	}
	
	Transite.prototype.search = function(){
		$('#search_btn').bind('click', function(){
			var keyword = $('#keyword').val();
			window.location.href = '?r=rewrite/rule' + '&keyword='+ keyword;
		});
	}

	Transite.prototype.pages = function(){
		var pagesize = $('#pagesize').html();

		var url = '?r=rewrite/rule' + '&pagesize='+ pagesize;
		var obj = {count:$('#count').html(), page:$('#pagenum').html(), pagesize:pagesize,url:url};
		new window.page(obj);
  
	}
	
	Transite.prototype.order = function(){
		for(var i=0; i<this._order_ele.length; ++i)
		{
			$(rewrite_rule.rows[0].cells[i]).bind('click',{order:this._order_ele[i]},function(e){
				var seq=orderflag.innerText;
				if(seq=="" || seq=="asc"){
					seq="desc";
				}else{
					seq="asc";
				}
				window.location.href = '?r=rewrite/rule' + '&orderby=' + e.data.order + '&seq='+ seq + '&page=1&pagesize=20';
			});
		}
	}
	
	new Transite();


})();
