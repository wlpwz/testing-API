(function(){
     var Downstream = function(){
		this._init();
	 }

	 Downstream.prototype._init = function(){
		var _this = this;
		_this.addExe();
	}
	Downstream.prototype.addExe = function(){
		$('#submit').bind('click', function(){
			var memory_ftp = $('#memory_ftp').val();
			if(memory_ftp == '' ){
				alert('请输入内存记录文件FTP地址！');
			}
            else{
				var reqUrl = "?r=tools/memorystatic";
				var param = {memory_ftp:memory_ftp};
				$.ajax({
					type:"POST",
					async:true,
					url:reqUrl,
					data:param,
					success:function(ajaxObj){
						var result = $.parseJSON(ajaxObj);
                                                if (result.result== 1)
                                                   { 
                                                     var src=result['0']['src'];
                                                     var $frame = $("#tu");
                                                     $frame.attr("src", src);
                                                     $("#maxmemory").val(result['0']['maxmemory']);
                                                     $("#minmemory").val(result['0']['minmemory']);
                                                     $("#averagememory").val(result['0']['averagememory']);
                                                   }
                                                  
				
					},
					error:function(){
					  //	alert("请联系QA反馈您遇到的问题!");
					}
				});
			}

		});
	}

   new  Downstream();

})();
