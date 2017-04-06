(function(){
	var PingVipOnline = function(){
		this._order_ele = ["date", "hour", "baike","blog","lvyou","space","tieba","wenku","zhidao"];
		this._init();
	}
	
	PingVipOnline.prototype._init = function(){
		this.pages();
		this.order();
	}
	
	PingVipOnline.prototype.pages = function(){
		var pagesize = $('#pagesize').html();

		var url = '?r=system/pingviponline&pagesize='+ pagesize;
		var obj = {count:$('#count').html(), page:$('#pagenum').html(), pagesize:pagesize,url:url};
		new window.page(obj);
  
	}
	
	PingVipOnline.prototype.order = function(){
		for(var i=0; i<this._order_ele.length; ++i)
		{
		$(vip_sitemap.rows[0].cells[i]).bind('click',{order:this._order_ele[i]},function(e){
			var seq=orderflag.innerText;
			if(seq=="" || seq=="asc"){
				seq="desc";
			}else{
				seq="asc";
			}
			window.location.href = '?r=system/pingviponline' + '&orderby=' + e.data.order + '&seq='+ seq + '&page=1&pagesize=20';
		});
		}
	}
	new PingVipOnline();
})();
