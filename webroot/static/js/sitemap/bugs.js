(function(){
	var SiteSearch = function(){
		this._order_ele = ["createdTime","title","status","resolveTime","src_from","icafe_url","phenomenon","symptom","cause"];
		this._init();
	}
	
	SiteSearch.prototype._init = function(){
		this.pages();
		this.search();
		this.order();
        this.editor();
	}
	
	SiteSearch.prototype.search = function(){
		$('#search_btn').bind('click', function(){
			var keyword = $('#keyword').val();
			window.location.href = '?r=requirement/bugs' + '&keyword='+ keyword;
		});
	}

	SiteSearch.prototype.pages = function(){
		var pagesize = $('#pagesize').html();

		var url = '?r=requirement/bugs' + '&pagesize='+ pagesize;
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
				window.location.href = '?r=requirement/bugs' + '&orderby=' + e.data.order + '&seq='+ seq + '&page=1&pagesize=20';
			});
		}
	}

    SiteSearch.prototype.editor = function(){
        $('.editor').bind('click', function(){
            var node = this.parentNode.parentNode;
            $(node).find("textarea").removeAttr("disabled");
            var sequence = $(this).attr('item_id');
        }); 
    }	
	new SiteSearch();


})();
