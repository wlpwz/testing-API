(function(){
	var keyword = $('#keyword').html();
	var page = $('#pagenum').html();
	var pagesize = $('#pagesize').html();

	var StatModuleList = function(){
		this._initBind();
	}	

	StatModuleList.prototype._initBind = function(){
		var _this = this;
		_this.search();
		_this.editor();
		_this.delete();
        _this.addItem();
		_this.items();
		_this.slidePage($('#count').html(), $('#pagenum').html(), $('#pagesize').html(), $('#offset').html());
	}

	StatModuleList.prototype.search = function(){
		$('#search_btn').bind('click', function(){
			window.location.href = "?r=statitem/index&keyword=" + $('#keyword').val();	
		});
	}

	StatModuleList.prototype.editor = function(){
		var back = '&keyword='+ keyword +'&pagesize=' + pagesize + '&page=' + page;
		$('.editor').bind('click',function(){
			window.location.href = "?r=statitem/edit&id=" + $(this).attr('item_id') + back;	
		});
	}
	
	StatModuleList.prototype.items = function(){
		var back = '&keyword='+ keyword +'&pagesize=' + pagesize + '&page=' + page;
		$('.items').bind('click', function(){
			window.location.href = "?r=statitem/items&mid=" + $(this).attr('item_id');	
		});
	
	}
	
	StatModuleList.prototype.delete = function(){
		$('.delete').bind('click', function(){
			var param = {id:$(this).attr('item_id')};
			if(confirm('确定要删除吗？')){
				$.ajax({
					type: "POST",
					async:true,
					url: "?r=statitem/del",
                    data: param,
					//dataType: "json",
					success: function(AjaxObj){
                         var obj = $.parseJSON(AjaxObj);
						 if(obj.status==1){
							alert('删除成功！');
							window.location.reload();
						 }else{
							alert('删除失败！');
						}
					},
					error: function(XMLHttpRequest, textStatus, errorThrown){
                        console.log(errorThrown);
						alert("请联系QA反馈您遇到的问题！");
					}

				});
			}

		});
	}

	StatModuleList.prototype.addItem = function(){
		$('#add_item').bind('click', function(){
			window.location.href = "?r=statitem/edit";	
		});
	}

    StatModuleList.prototype.slidePage = function(count, page, pagesize, offset){
	    const NUM = 10;	
		//var html = '<span class="total-num">共' + count + '条</span><ul>';
		var url = '?r=statitem/index&keyword='+ $('#keyword').val() +'&pagesize='+ pagesize;
        var pageCount = Math.ceil(count/pagesize);	
        var mid = Math.ceil(NUM/2);	
        var total = (pageCount <= NUM)?pageCount:NUM;
        var off = 0;

		var html = '<ul class="right">';	
		if(pageCount > 1){
			if(page == 1){
				html += '<li class="disabled">';
			}else{
				html += '<li class="active">';
			}
			html += '<a href="' + url +'&page=1">首页</a></li>';
			
            if(pageCount>NUM){
				//超过最大页码时，或未超过最大页码但超过num/2页面时
				(((page-mid+NUM) > pageCount) && ( off = pageCount - NUM)) || ((page>mid) && (off = page - mid)); 
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

    //入口	
	new StatModuleList();

})();