(function(){
	var Downstream = function(){
		this._init();
	}
	Downstream.prototype._init = function(){
		var _this = this;
		_this.submit();
	}
	Downstream.prototype.submit = function(){
		$('#submit_task').bind('click', function(){
			var task_name = $('#task_name').val();
			if (task_name == "")
			{
				alert("请输入任务名！");
				return;
			}
			var data_path1 = $('#data_path').val();
			//if(data_path1 == ""){
			  //  alert("请输入性能指标");
			var data_path_qps1 = $('#data_path_qps').val();
			if(data_path1 == "" && data_path_qps1 == ""){
			    alert("请输入一个性能指标的ftp地址");
				return; 
			}
			var data_path = data_path1.replace(/(^\s*)|(\s*$)/g, "");
			var data_path_qps = data_path_qps1.replace(/(^\s*)|(\s*$)/g, "");
			
			
			var data_user = $('#data_user').val();
			var comment = $('#comment').val();
			var data_method = $("input[type='radio'][name='method']:checked").val();
			
			//var param = {task_name:task_name,data_path:data_path,data_user:data_user,comment:comment,data_method:data_method};
			var param = {task_name:task_name,data_path:data_path,data_path_qps:data_path_qps,data_user:data_user,comment:comment,data_method:data_method};
			console.log(param); 
			//return ;
			var reqUrl = "?r=performance/submit";
			$.ajax({
				type:"POST",
				async:true,
				url:reqUrl,
				data:param,
				success:function(ajaxObj){
					var result = $.parseJSON(ajaxObj);
					//if (result.result== 1)
					if(result.result== -1)
					{
						alert("任务地址不存在或机器不支持wget！")
					}
					else if (result.result== 3 || result.result== 2)
					{
						var id=result.task_id;

						alert("[任务启动成功，任务id为："+ id + "], 请到性能平台结果页面查看.");
						window.location.href = "?r=performance/task";
					}
					else if(result.result== 1)
					{
						var id=result.task_id;
						alert("[任务启动成功，任务id为："+ id + "], 请到性能平台结果页面查看.");
						window.location.href = "?r=performance/qpstask";
					}
				},
				err:function(){
					alert("任务启动失败，请联系QA反馈您遇到的问题!");
				}
			});
		});
	}
	
	new  Downstream();
})();
