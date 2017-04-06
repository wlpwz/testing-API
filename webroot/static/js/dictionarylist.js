(function(){
	var Downstream = function(){
		this._init();
	}
	Downstream.prototype._init = function(){
		var _this = this;
		_this.addExe();
	}
	Downstream.prototype.addExe = function(){
		$('.s1').bind('click', function(){
			var status = 4;
			var id = $(this).val();
			if(confirm("确认发起上线？")){
			var param={status:status,id:id};
			var reqUrl = "?r=dictionary/changeTaskStatusAPI";
            console.log(param);
			$.ajax({
				type:"POST",
				async:true,
				url:reqUrl,
				data:param,
                dataType:"json",
				success:function(ajaxObj){
                    //alert(1);
                   // console.log(ajaxObj);
                    
					//var result = $.parseJSON('{"result":"1"}');
					var result = ajaxObj;
					if (result.result== 1)
					{
						var id=result.task_id;
						window.location.href = "?r=dictionary/task";
					}
				},
				error:function(){
					alert("失败!");
				}
			});
			}
		});
		$('.s2').bind('click', function(){
			var status = 11;
			var id = $(this).val();
			if(confirm("确认仅作测试？")){	
				var param={status:status,id:id};
				var reqUrl = "?r=dictionary/changeTaskStatusAPI";
				$.ajax({
					type:"POST",
					async:true,
					url:reqUrl,
					data:param,
                    dataType:"json",
					success:function(ajaxObj){
						var result = ajaxObj;
						if (result.result== 1)
						{
							var id=result.task_id;
							window.location.href = "?r=dictionary/task";
						}
					},
					error:function(){
						alert("失败!");
					}
				});
			}
		});
		$('.s3').bind('click', function(){
			var id = $(this).val();	
			if(confirm("QA确认:如果确认符合预期点击确认按钮,不符合预期点击取消按钮")){	
			var status = 5;
			var param={status:status,id:id};
			var reqUrl = "?r=dictionary/changeTaskStatusAPI";
			$.ajax({
				type:"POST",
				async:true,
				url:reqUrl,
				data:param,
                dataType:"json",
				success:function(ajaxObj){
					var result = ajaxObj;
					if (result.result== 1)
					{
						var id=result.task_id;
						//alert("任务启动成功，请在“词典测试结果列表”查看进度");
						window.location.href = "?r=dictionary/task";
					}
				},
				error:function(){
					alert("失败!");
				}
			});
            
			}
			else
			{
				var status = 9;
				var param={status:status,id:id};
				var reqUrl = "?r=dictionary/changeTaskStatusAPI";
			$.ajax({
				type:"POST",
				async:true,
				url:reqUrl,
				data:param,
                dataType:"json",
				success:function(ajaxObj){
					var result = ajaxObj;
					if (result.result== 1)
					{
						var id=result.task_id;
						//alert("任务启动成功，请在“词典测试结果列表”查看进度");
						window.location.href = "?r=dictionary/task";
					}
				},
				error:function(){
					alert("失败!");
				}
			});
				
			}
		});
		$('.s4').bind('click', function(){
            
            var id = $(this).val(); 
            if(confirm("RD确认:如果效果符合预期点击确认按钮，否则点击取消按钮")){
				var status = 6;
            	var param={status:status,id:id};
            	var reqUrl = "?r=dictionary/changeTaskStatusAPI";
            	$.ajax({
                	type:"POST",
                	async:true,
               	 	url:reqUrl,
                	data:param,
                    dataType:"json",
                	success:function(ajaxObj){
                    	var result = ajaxObj;
                    	if (result.result== 1)
                    	{       
                        	var id=result.task_id;
                        	//alert("任务启动成功，请在“词典测试结果列表”查看进度");
							window.location.href = "?r=dictionary/task";
                    	}       
                	},      
                	error:function(){
                    alert("失败!");
                	}       
            	});
			}
			else
			{
				status=10;
            	var param={status:status,id:id};
            	var reqUrl = "?r=dictionary/changeTaskStatusAPI";
            	$.ajax({
                	type:"POST",
                	async:true,
               	 	url:reqUrl,
                	data:param,
                    dataType:"json",
                	success:function(ajaxObj){
                    	var result = ajaxObj;
                    	if (result.result== 1)
                    	{       
                        	var id=result.task_id;
                        	//alert("任务启动成功，请在“词典测试结果列表”查看进度");
							window.location.href = "?r=dictionary/task";
                    	}       
                	},      
                	error:function(){
                    alert("失败!");
                	}       
            	});
				
			}     
        }); 
		$('.s5').bind('click', function(){
            var status = 7;
            var id = $(this).val();
            if(confirm("更新沙盒环境词典:点击确认按钮，不更新沙盒：点击取消按钮")){
				var status = 7;
            	var param={status:status,id:id};
            	var reqUrl = "?r=dictionary/changeTaskStatusAPI";
            	$.ajax({
                	type:"POST",
                	async:true,
               	 	url:reqUrl,
                	data:param,
                    dataType:"json",
                	success:function(ajaxObj){
                    	var result = ajaxObj;
                    	if (result.result== 1)
                    	{       
                        	var id=result.task_id;
							window.location.href = "?r=dictionary/task";
                    	}       
                	},      
                	error:function(){
				    window.location.href = "?r=dictionary/task";
                	}       
            	});

			}   
            $('.s5').attr("disabled","disabled");
        }); 
		   
 
		$('.s6').bind('click', function(){
            var status = 12;
            var id = $(this).val();
            if(confirm("更新线上环境词典:点击确认按钮，不更新线上：点击取消按钮")){
				var status = 12;
            	var param={status:status,id:id};
            	var reqUrl = "?r=dictionary/changeTaskStatusAPI";
            	$.ajax({
                	type:"POST",
                	async:true,
               	 	url:reqUrl,
                	data:param,
                    dataType:"json",
                	success:function(ajaxObj){
                        var result = ajaxObj;
                    	if (result.result== 1)
                    	{       
                        	var id=result.task_id;
							window.location.href = "?r=dictionary/task";
                    	}       
                	},      
                	error:function(){
                    window.location.href = "?r=dictionary/task";
                	}       
            	});
            }
            $('.s6').attr("disabled","disabled");
        }); 
		   
	}
	new  Downstream();
})();
