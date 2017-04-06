(function(){
    var actManage = function(){
        var _this = this;

        _this._init();
            
    }
    
    actManage.prototype._init = function(){
        var _this = this;
		
		_this.editor();
		_this.del();
		_this.search();
		_this.pages();
    }   

	actManage.prototype.search = function(){
		$('#search_btn').bind('click', function(){
			var keyword = $('#keyword').val();
			window.location.href = "?r=actManage/index&keyword=" + keyword; 
		});
	}
	
	actManage.prototype.pages = function(){
		var keyword = $('#keyword').html();
		var pagesize = $('#pagesize').html();
		
		var url = '?r=actManage/index' + '&keyword='+ $('#keyword').val() +'&pagesize='+ pagesize;
		var obj = {count:$('#count').html(), page:$('#pagenum').html(), pagesize:pagesize,url:url};
		new window.page(obj);
	}
	
	actManage.prototype.editor = function(){
		var url = "?r=actManage/edit";
		$('.edit').bind('click', function(){
			var td = $(this).parent();
			var act_id = $(td).attr('aid');
			
			url += "&id=" + act_id;
			window.location.href = url;
		});
	}
	
    actManage.prototype.del = function(){
		$('.delete').bind('click', function(){
			var td = $(this).parent();
			var act_id = $(td).attr('aid');
		
			var url = "?r=actManage/del";
			var param = {id:act_id};
			if(confirm("确定要删除吗？")){
				$.ajax({
					type: "POST",
					url: url,
					data: param,
					async: false,
					success: function(ajaxObj){
						var obj = $.parseJSON(ajaxObj);
						if(obj.status==1){
							alert('删除成功！');
						}else{
							alert('删除失败，请稍候重试！');
						}
						window.location.reload();
					},
					error: function(XMLHttpRequest, textStatus, errorThrown){
						console.log(errorThrown);
						alert("请联系QA反馈您的问题！");
					}
				});	
			}});
	}                                                                                                
                                                                                                                    
    new actManage();                                                                                                
})();
