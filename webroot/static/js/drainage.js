(function(){
 	var ck_dest = getCookie("dest");
 	if(ck_dest) {
		$('#drainage_dest').val(ck_dest);
	}
 	var ck_port = getCookie("port");
 	if(ck_port) {
		$('#drainage_port').val(ck_port);
	}
//	function setCookie(kvs, exptime) {
//		var str = "";
//		for(key in kvs) {
//			str += "; " + key + "=" + escape(kvs[key]);
//		}
//		if(exptime) {
//			var exp = new Date();
//			exp.setTime(exp.getTime() + exptime);
//			str += "; expires=" + exp.toGMTString();
//		}
//		alert(str);
//		document.cookie = str.substring(2);
//		alert(document.cookie);
//	}
	function setCookie(key, val, exptime) {
		var str_exp = "";
		if(exptime) {
			var exp = new Date();
			exp.setTime(exp.getTime() + exptime);
			str_exp = "; expires=" + exp.toGMTString();
		}
		document.cookie = key + "=" + escape(val) + str_exp;
	}
 	function getCookie(key) {
		var reg = new RegExp("(^| |;)"+key+"=([^;]*)($|;)");
		var arr = document.cookie.match(reg);
		if (arr) return unescape(arr[2]);
		else return null;
	}
	var Downstream = function(){
		this._init();
	}
	Downstream.prototype._init = function(){
		var _this = this;
		_this.submit();
		_this.cancel();
		_this.stop();
		_this.type_info();
//		_this.add();
//		_this.del();
	}
	Downstream.prototype.submit = function(){
		$('#submit_task').bind('click', function(){
			
			var dur_hour = $('#drainage_hour').val();
			var dur_minute = $('#drainage_minute').val();
			if (dur_hour == "0" && dur_minute == "0") {
				alert("请指定引流时间");
				return;
			}
			var dtype = $('#drainage_type').val();
			var dest = $('#drainage_dest').val();
			if (dest == "") {
				alert("请输入引流目标地址");
				return;
			}
			var port = $('#drainage_port').val();
			if (port == "") {
				alert("请输入引流目标端口");
				return;
			}
			var port_int = parseInt(port);
			if (isNaN(port_int) || port_int < 0 || port_int >65535) {
				alert("端口非法");
				return;
			}

//			setCookie({dest:dest,port:port_int});
			setCookie('dest', dest);
			setCookie('port',port_int);
			
			var param = {hour:dur_hour,minute:dur_minute,type:dtype,dest:dest,port:port_int};
			console.log(param); 
			var reqUrl = "?r=drainage/submit";
			$.ajax({
				url:reqUrl,
				type:"POST",
				async:true,
				data:param,
				dataType:"json",
				success:function(ajaxObj){
					//var result = $.parseJSON(ajaxObj);
					if (ajaxObj.result == 1)
					{
						var id=ajaxObj.task_id;
						alert("任务启动成功，任务id为："+ id);
						window.location.href = "?r=drainage/index";
					}
					else {
						alert("任务启动失败，错误信息为："+ ajaxObj.res_info);
					}	
				},
				err:function(){
					alert("任务启动失败，请联系QA反馈您遇到的问题!");
				},
				complete:function(){
					$('#submit_task').removeAttr("disabled");
				}
			});

			$(this).attr("disabled", "disabled");
		});
	}
	Downstream.prototype.cancel = function(){
		$('#cancel_input').bind('click', function(){
			$('#drainage_dest').val("");
			$('#drainage_port').val("");
		});
	}
	Downstream.prototype.stop = function(){
		$('#result_info').find('button').bind('click', function(){
			var id = $(this).parent().parent().children('td:first').text();
			if(confirm("是否终止任务id=" + id)) {
				$.ajax({
					url:"?r=drainage/stop",
					type:"POST",
					async:true,
					data:{id:id},
					dataType:"json",
					success:function(ajaxObj){
						//var result = $.parseJSON(ajaxObj);
						if (ajaxObj.result == 1)
						{
							alert("任务停止成功，任务id为："+ ajaxObj.id + "\n任务进程号pid为：" + ajaxObj.pid);
							window.location.href = "?r=drainage/index";
						}
					},
					err:function(){
						alert("任务停止失败，请联系QA反馈您遇到的问题!");
					}
				});
			}
		});
	}
	Downstream.prototype.type_info = function(){
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
