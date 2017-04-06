(function(){
	var Downstream = function(){
		this._init();
	}
	Downstream.prototype._init = function(){
		var _this = this;
		_this.add();
		_this.del();
		_this.submit();
	}
	Downstream.prototype.submit = function(){
		$('#submit_task').bind('click', function(){
			var language = $('input:radio[name="language"]:checked').val();
			if (document.getElementById("newolddiff").checked==true)
                var newold = 1;
            else    
                var newold = 0;
            if (document.getElementById("memory").checked==true)
                var memory = 1;
            else
                var memory = 0;
            if (document.getElementById("speed").checked==true)
                var speed = 1;
			else
				var speed = 0;
			/**************获取词典来源**********/
			var method = $('input:radio[name="method"]:checked').val();
			if ( method == 0 )
			{
				var source = $('#dictionary_source').val();
				var source_data = $('#source_data').val();
				if (source_data=='')
				{
					alert("请输入来源地址！");
					return;
				}
				source = source + ":" + source_data;
			}
			else if( method == 1 )
			{
				if ($('input[name="input_key"]').val()=="")
				{
						alert("请输入来源地址！");
						return;
				}
				var input_key = $('input[name="input_key"]').serialize();	
				alert(input_key);
				var input_value = $('input[name="input_value"]').serialize();
				alert(input_value);
			}
		
			/**************词典名称**********/
			var dictionary_name = $('#dictionary_name').val();
			/**************end**********/
			/**用户名**/
			var head = $('#head').val();
			/**推送原因**/
			var reason = $('#reason').val();
			if (reason == "")
			{
				alert("请输入推送原因！");
				return;
			}
			var function_point = $('#function_point').val();
			if (method ==0)
				var param = {language:language,method:method,source:source,dictionary_name:dictionary_name,head:head,reason:reason,memory:memory,speed:speed,newold:newold};
			else if (method ==1)
				var param = {language:language,method:method,input_key:input_key,input_value:input_value,dictionary_name:dictionary_name,head:head,reason:reason,memory:memory,speed:speed,newold:newold};
			console.log(param); 
			//return ;
			var reqUrl = "?r=dictionary/submit";
			$.ajax({
				type:"POST",
				async:true,
				url:reqUrl,
				data:param,
				success:function(ajaxObj){
					var result = $.parseJSON(ajaxObj);
					if (result.result== 1)
					{
						var id=result.task_id;
						alert("任务启动成功，任务id为："+ id + "，请在“词典测试结果列表”查看进度");
					}
				},
				err:function(){
					alert("任务启动失败，请联系QA反馈您遇到的问题!");
				}
			});
		});
	}
	
	Downstream.prototype.add = function(){
		var _this = this;
		$('#input_items').delegate('.add_input', 'click', function(){
			var pane = document.createElement('div');
				pane.className = "col-item";
			var html = '';
				html += '<span class="input-icon">';
				html += '<input type="text" name="input_key" placeholder="site/index">';
				html += '</span>';
				html += '<span class="input-icon input-icon-right">';
				html += '<input type="text" name="input_value" placeholder="*site/index*" class="mar-left4">';
				html += '</span>';
				html += '<a href="javascript:;" class="add_input mar-left4"><i class="fa fa-plus"></i></a>';
				html += '<a href="javascript:;" class="del_input mar-left4"><i class="fa fa-minus"></i></a>';
				pane.innerHTML = html;
				$('#input_items').append(pane);
		});	
	}
	Downstream.prototype.del = function(){
		$('#input_items').delegate('.del_input', 'click', function(){
			$(this).parent().remove();
		});
	}
	new  Downstream();
})();
